<?php

namespace app\models\base;

use Yii;

/**
 * This is the base-model class for table "role_menu".
 *
 * @property integer $id
 * @property integer $role_id
 * @property integer $menu_id
 *
 * @property \app\models\Role $role
 * @property \app\models\Menu $menu
 */
class RoleMenu extends \yii\db\ActiveRecord
{
    use \app\traits\ModelTrait;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'role_menu';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['role_id', 'menu_id'], 'required'],
            [['role_id', 'menu_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('models', 'ID'),
            'role_id' => Yii::t('models', 'Role'),
            'menu_id' => Yii::t('models', 'Menu'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRole()
    {
        return $this->hasOne(\app\models\Role::class, ['id' => 'role_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMenu()
    {
        return $this->hasOne(\app\models\Menu::class, ['id' => 'menu_id']);
    }
}
