<?php

namespace app\models;

use app\components\Constant;
use \app\models\base\Action as BaseAction;
use Yii;

/**
 * This is the model class for table "action".
 */
class Action extends BaseAction
{
    public static function getAccess($controllerId, $module = "BASE")
    {
        $rules = [];
        $menu = Menu::find()->where(['controller' => $controllerId, 'module' => $module])->asArray()->one();
        if ($menu) {
            $rules[] = [
                "allow" => true,
                "actions" => explode(',', $menu['except'])
            ];
        }

        if (\Yii::$app->user->identity != null) {
            $roles[] = Constant::getUser()->role_id;

            $allowed = Action::getAllowedAction($controllerId, $roles);

            if (count($allowed) != 0) {
                $rules[] = [
                    'actions' => $allowed,
                    'allow' => true,
                    'roles' => ['@'],
                ];
            }
        }

        $rules[] = [
            'allow' => false,
        ];

        return [
            'as beforeRequest' => [
                'class' => 'yii\filters\AccessControl',
                'rules' => $rules,
            ],
        ];
    }

    public static function getAllowedAction($controllerId, $role_id)
    {
        $output = [];
        foreach (Action::find()->where(["controller_id" => $controllerId])->asArray()->all() as $action) {
            foreach ($role_id as $r) {
                //bypass for super admin
                if ($r == 1) {
                    $output[] = $action['action_id'];
                } else {
                    $roleAction = RoleAction::find()->where([
                        "and",
                        ["action_id" => $action['id']],
                        [
                            "in",
                            "role_id",
                            $r
                        ],
                    ])->exists();
                    if ($roleAction) {
                        $output[] = $action['action_id'];
                    }
                }
            }
        }

        return $output;
    }
}
