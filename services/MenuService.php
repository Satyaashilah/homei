<?php

namespace app\services;

use app\models\Menu;
use app\models\RoleMenu;
use app\services\base\Service;
use Yii;
use yii\helpers\ArrayHelper;

class MenuService extends Service
{
    use \app\traits\MessageTrait;

    public $model = Menu::class;

    public function getModel()
    {
        return new $this->model;
    }

    public function findAllModule()
    {
        return $this->model::find()->distinct()->select('module')->column();
    }

    public function findMenuByParent($id = null)
    {
        $model = $this->getModel();
        return $model->find()->where(['parent_id' => $id])->orderBy('order')->asArray()->all();
    }

    public function getSelect2Parent()
    {
        return ArrayHelper::map($this->findMenuByParent(), 'id', 'name');
    }

    public function getNestedData()
    {
        $list_parent_menu = $this->findMenuByParent();

        $recursion = 0;
        $this->recursion($list_parent_menu, $recursion);

        return $list_parent_menu;
    }

    private function recursion(&$parent, &$recursion)
    {
        $recursion++;
        foreach ($parent as $key => $value) {
            $parent[$key]['children'] = $this->findMenuByParent($value['id']);
            if (!empty($parent[$key]['children'])) {
                $this->recursion($parent[$key]['children'], $recursion);
            }
        }
        $recursion--;
    }

    public function findById(String $id)
    {
        return $this->model::find()->where(["id" => $id])->one();
    }

    public function findDataForUpdate(String $id)
    {
        $menu = $this->findById($id);
        if (!$menu) {
            return null;
        }
        $menu->icon = str_replace("fa ", "", $menu->icon);
        return $menu;
    }

    public function create(Menu $menu, $request)
    {
        $menu->load($request->post());
        $menu->icon = str_replace("fa ", "", $menu->icon);
        $menu->icon = "fa " . $menu->icon;

        $menu->module = $menu->module !== ""
            ? $menu->module
            : 'BASE';

        if ($menu->save()) return true;
        return false;
    }

    public function save($request)
    {
        $str = $request->post('str');
        if (!$str) {
            return false;
        }
        $trs = explode("||", $str);
        $no = 1;

        $transaction = \Yii::$app->db->beginTransaction();
        foreach ($trs as $tr) {
            $obj = explode("[=]", $tr);
            $menu = $this->findById($obj[0]);
            if ($menu) {
                $menu->name = $obj[1];
                $menu->controller = $obj[2];
                $menu->parent_id = $obj[3];
                $menu->order = $no;
                $menu->icon = "fa " . str_replace("fa ", "", $obj[4]);
                if ($obj[5] === '') {
                    $menu->module = 'BASE';
                } else {
                    $menu->module = $obj[5];
                }
                $menu->except = $obj[6];

                if ($menu->validate() == false) {
                    $transaction->rollBack();
                    return false;
                }

                $menu->save();
                $no++;
            }
        }

        $transaction->commit();
        return true;
    }

    public function prepareForView($modules)
    {
        $results = [];
        foreach ($modules as $module) {
            $results[$module] = $module;
        }
        return $results;
    }

    public static function getModuleParentID($module)
    {
        $special_module = explode(",", Yii::$app->params['special_module']) ?? [];
        foreach ($special_module as $key => $value) {
            if (Menu::find()->where(["module" => $module])->count() == 1) {
                return Menu::find()->where(["module" => $module])->select('parent_id')->column()[0];
            }
        }
        return null;
    }

    public function delete(int $id)
    {
        $menu = $this->findById($id);
        $transaction = \Yii::$app->db->beginTransaction();
        try {
            if ($menu) {
                // delete all role_menu
                RoleMenu::deleteAll(['menu_id' => $id]);
                // delete menu
                $menu->delete();
                $transaction->commit();
                return [
                    'success' => true,
                    'message' => 'Delete menu success'
                ];
            }

            $transaction->rollBack();
            return [
                'success' => true,
                'message' => 'Delete menu failed'
            ];
        } catch (\Throwable $th) {
            $transaction->rollBack();
            return [
                'success' => true,
                'message' => 'Delete menu failed : ' . $th->getMessage()
            ];
        }
    }
}
