<?php

namespace app\modules\android\models;

use Yii;
use \app\modules\android\models\base\AndroidMenu as BaseAndroidMenu;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "android_menu".
 * Modified by Defri Indra M
 */
class AndroidMenu extends BaseAndroidMenu
{
    const MENU_ANDROID_TYPES = [
        "external_links" => "Eksternal Link",
        "embed_menu" => "Embed Menu"
    ];

    public function behaviors()
    {
        return ArrayHelper::merge(
            parent::behaviors(),
            [
                # custom behaviors
            ]
        );
    }

    public function rules()
    {
        return ArrayHelper::merge(
            parent::rules(),
            [
                # custom validation rules
            ]
        );
    }
}
