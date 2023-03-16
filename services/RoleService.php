<?php

namespace app\services;

use app\models\Action;
use app\models\Menu;
use app\models\Role;
use app\models\RoleAction;
use app\models\RoleMenu;
use app\models\search\RoleSearch;
use app\models\User;
use app\services\base\Service;
use ReflectionClass;
use yii\helpers\Inflector;

class RoleService extends Service
{
    use \app\traits\MessageTrait;
    public $model = 'app\models\Role';
    public $directoryList = ["api/", "backend/"];

    public function prepareDataProvider()
    {
        $searchModel = new RoleSearch();
        $dataProvider = $searchModel->search($_GET);
        return compact('searchModel', 'dataProvider');
    }

    public function getModel()
    {
        return new $this->model;
    }

    public function create($model, $data)
    {
        $model->load($data);
        if ($model->save()) {
            return $model;
        }
        return false;
    }

    public function findById($id)
    {
        return $this->model::find()->where(["id" => $id])->one();
    }

    public function findDataForUpdate(String $id)
    {
        $role = $this->findById($id);
        if (!$role) {
            return null;
        }
        return $role;
    }

    public function update($model, $data)
    {
        $model->load($data);
        if ($model->save()) {
            return $model;
        }
        return false;
    }

    public function delete($id)
    {

        $model = $this->findById($id);
        if (!$model) {
            return ["success" => false, "message" => "Role not found"];
        }
        $transaction = \Yii::$app->db->beginTransaction();
        try {
            RoleAction::deleteAll(['role_id' => $id]);
            RoleMenu::deleteAll(['role_id' => $id]);
            if (User::find()->where(['role_id' => $id])->exists()) {
                return ["success" => false, "message" => "Role is used by user"];
            }
            if ($model->delete()) {
                $transaction->commit();
                return ["success" => true, "message" => "Role deleted"];
            }
        } catch (\Throwable $th) {
            $transaction->rollBack();
            return ["success" => false, "message" => "Delete role failed"];
        }

        $transaction->rollBack();
        return ["success" => false, "message" => "Delete role failed"];
    }

    private function removeRelations(Role $model, string $module)
    {
        $id = $model->id;
        $controllerQuery = Menu::find()->where(["module" => $module]);
        $menu = clone $controllerQuery;
        $role_action = Action::find()->andWhere(["controller_id" => $controllerQuery->select('controller')]);

        try {
            RoleMenu::deleteAll(["role_id" => $id, "menu_id" => $menu->select('id')]);
            RoleAction::deleteAll(["role_id" => $id, "action_id" => $role_action->select('id')]);
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    private function insertMenu($model, $data)
    {
        if (empty($data)) {
            return true;
        }

        foreach ($data as $menu) {
            $roleMenu = new RoleMenu();
            $roleMenu->role_id = $model->id;
            $roleMenu->menu_id = $menu;
            if (!$roleMenu->save()) {
                throw new \Exception("Insert role menu failed");
            }
        }

        return true;
    }

    private function insertAction($model, $data)
    {
        if (empty($data)) {
            return true;
        }

        foreach ($data as $action) {
            if($action) {
                $roleAction = new RoleAction();
                $roleAction->role_id = $model->id;
                $roleAction->action_id = $action;
                if (!$roleAction->save()) {
                    throw new \Exception("Insert action failed");
                }
    
                $roleAction->save();
            }
        }

        return true;
    }

    public function detail(Role $model, array $request, string $module)
    {
        if (!$model) {
            return false;
        }

        $transaction = $model->getDb()->beginTransaction();

        try {
            $this->removeRelations($model, $module);
            $this->insertMenu($model, $request['menus']);
            $this->insertAction($model, $request['actions']);
        } catch (\Throwable $th) {
            $transaction->rollBack();

            \Yii::error($th->getMessage());
            return false;
        }

        $transaction->commit();
        return true;
    }


    function isChecked($role_id, $menu_id)
    {
        $role_menu = \app\models\RoleMenu::find()->where(["menu_id" => $menu_id, "role_id" => $role_id])->exists();
        if ($role_menu) {
            return TRUE;
        }
        return FALSE;
    }

    function hasAccessToAction($role_id, $action_id)
    {
        $role_menu = RoleAction::find()->where(["action_id" => $action_id, "role_id" => $role_id])->exists();
        if ($role_menu) {
            return TRUE;
        }
        return FALSE;
    }

    private function getFullControllerName($module, $menu, $camel_name)
    {
        if ($module != "BASE") {
            $namespace = "app\\modules\\$module\\controllers\\";
        } else {
            $namespace = "app\\controllers\\";
        }

        $full_controller_name = $namespace . $camel_name . "Controller";

        $directoryList = $this->directoryList;

        foreach ($directoryList as $directory) {
            if (substr(strtolower($camel_name), 0, strlen($directory)) == strtolower($directory)) {
                $arr_name_api = explode('/', $menu->controller);
                $c_name_api = end($arr_name_api);
                $prefix = implode("\\", $arr_name_api);

                $camel_name =  Inflector::id2camel($c_name_api);
                $full_controller_name = $namespace . "$prefix\\" . $camel_name . "Controller";

                break; // break if found
            }
        }


        return $full_controller_name;
    }

    private function checkFunctionRegistered($full_controller_name, $camel_name, $module)
    {
        // custom registration actions
        $class_name = new $full_controller_name($camel_name . "Controller", $module, []);
        $registered_actions = array_keys($class_name->actions());
        $methods = [];
        foreach ($registered_actions as $val) {
            $methods[] = (object)[
                "name" => "action" . ucwords($val),
                "class" => $full_controller_name,
            ];
        }
        return $methods;
    }


    public function getAllChild($module, $role_id, $parent_id = null)
    {
        $parents = [];
        if ($module) :
            $data_module = $this->_getAllChild($module, $role_id, $parent_id);
            foreach ($data_module as $value) :
                $parents[] = $value;
            endforeach;
        endif;

        return $parents;
    }
    protected function _getAllChild($module, $role_id, $parent_id = NULL, $level = 0)
    {
        if ($module === "ALL") {
            $menus = \app\models\Menu::find()->where(["parent_id" => $parent_id])->select('id,name,controller,module')->asArray()->all();
        } else {
            $menus = \app\models\Menu::find()->where(["module" => $module, "parent_id" => $parent_id])->select('id,name,controller,module')->asArray()->all();
        }

        $real_module = $module;

        foreach ($menus as $index_menu => $menu) {
            if ($module == "ALL") {
                $module = $menu['module'];
            }
            //Show All Actions
            $camel_name = Inflector::id2camel($menu['controller']);
            $full_controller_name = $this->getFullControllerName($module, $menu, $camel_name);

            if (class_exists($full_controller_name)) {
                $reflection = new ReflectionClass($full_controller_name);
                $methods = $reflection->getMethods();

                $methods = array_merge($methods, $this->checkFunctionRegistered($full_controller_name, $camel_name, $module));

                foreach ($methods as $method) {
                    if (substr($method->name, 0, 6) == "action" && $method->name != "actions") {
                        $camel_action = substr($method->name, 6);
                        $id = Inflector::camel2id($camel_action);
                        $name = Inflector::camel2words($camel_action);
                        $action = Action::find()->where(["action_id" => $id, "controller_id" => $menu['controller']])->select('id, name')->asArray()->one();
                        if (!$action) {
                            //If the action not in database, save it !
                            $action = new \app\models\Action();
                            $action->action_id = $id;
                            $action->controller_id = $menu['controller'];
                            $action->name = $name;

                            
                            // if(!$action->validate()) {
                            //     var_dump($menu);
                            //     var_dump($action->getErrors());die;
                            // }
                            $action->save();

                            $action_id = $action->id;
                        } else {
                            $action_id = $action['id'];
                        }

                        $menus[$index_menu]['actions'][] = [
                            "id" => $action_id,
                            "name" => $name,
                            "has_access" => $this->hasAccessToAction($role_id, $action['id']),
                        ];
                    }
                }
            } else {
                $menus[$index_menu]['actions'] = [];
            }

            $menus[$index_menu]['show'] = $this->isChecked($role_id, $menu['id']);
            $menus[$index_menu]['level'] = $level;
            $menus[$index_menu]['children'] =  $this->_getAllChild($real_module, $role_id, $menu['id'], $level + 1);
        }

        return $menus;
    }
}
