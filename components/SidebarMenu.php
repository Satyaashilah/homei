<?php

namespace app\components;

use yii\bootstrap\Widget;
use app\models\Menu;

class SidebarMenu extends Widget
{
    public static function getMenu($roleId, $parentId = NULL)
    {
        $output = [];
        foreach (Menu::find()->where(["parent_id" => $parentId])->orderBy(['order' => SORT_ASC])->asArray()->all() as $menu) {
            $obj = [
                "label" => $menu['name'],
                "icon" => $menu['icon'],
                "url" => SidebarMenu::getUrl($menu),
                "visible" => SidebarMenu::roleHasAccess($roleId, $menu['id']),
            ];

            if (Menu::find()->where(["parent_id" => $menu['id']])->exists()) {
                $obj["items"] = SidebarMenu::getMenu($roleId, $menu['id']);
            }

            $output[] = $obj;
        }
        return $output;
    }

    private static function roleHasAccess($roleId, $menuId)
    {
        $roleMenu = \app\models\RoleMenu::find()->where(["menu_id" => $menuId, "role_id" => $roleId])->exists();
        if ($roleMenu) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    private static function getUrl($menu)
    {
        if ($menu['controller'] == NULL) {
            return "#";
        } else {
            $url = "";
            if ($menu['module'] !== "BASE") $url .= "/" . $menu['module'];
            $url .= "/" . $menu['controller'];
            $url .= "/" . $menu['action'];
            return [$url];
        }
    }
}
