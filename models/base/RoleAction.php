<?php

namespace app\models\base;

use Yii;

/**
 * This is the base-model class for table "role_action".
 *
 * @property integer $id
 * @property integer $role_id
 * @property integer $action_id
 *
 * @property \app\models\Role $role
 * @property \app\models\Action $action
 */
class RoleAction extends \yii\db\ActiveRecord
{
    use \app\traits\ModelTrait;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'role_action';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['role_id', 'action_id'], 'required'],
            [['role_id', 'action_id'], 'integer']
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
            'action_id' => Yii::t('models', 'Action'),
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
    public function getAction()
    {
        return $this->hasOne(\app\models\Action::class, ['id' => 'action_id']);
    }
}
