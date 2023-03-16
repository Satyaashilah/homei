<?php

namespace app\models\base;

use Yii;

/**
 * This is the base-model class for table "menu".
 *
 * @property integer $id
 * @property string $name
 * @property string $controller
 * @property string $action
 * @property string $icon
 * @property integer $order
 * @property integer $parent_id
 *
 * @property \app\models\Menu $parent
 * @property \app\models\Menu[] $menus
 * @property \app\models\RoleMenu[] $roleMenus
 */
class Menu extends \yii\db\ActiveRecord
{
    use \app\traits\ModelTrait;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%menu}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'controller', 'icon'], 'required'],
            [['order', 'parent_id'], 'integer'],
            [['name', 'controller', 'action', 'icon', 'module'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('models', 'ID'),
            'name' => Yii::t('models', 'Name'),
            'controller' => Yii::t('models', 'Controller'),
            'Module' => Yii::t('models', 'Module'),
            'action' => Yii::t('models', 'Action'),
            'icon' => Yii::t('models', 'Icon'),
            'order' => Yii::t('models', 'Order'),
            'parent_id' => Yii::t('models', 'Parent'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(\app\models\Menu::class, ['id' => 'parent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMenus()
    {
        return $this->hasMany(\app\models\Menu::class, ['parent_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoleMenus()
    {
        return $this->hasMany(\app\models\RoleMenu::class, ['menu_id' => 'id']);
    }
}
