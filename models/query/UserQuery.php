<?php

namespace app\models\query;

class UserQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        $this->andWhere(['user.flag' => 1]);
        return $this;
    }

    public function joinRole()
    {
        $this->innerJoin('role', 'role.id = user.role_id');
        return $this;
    }
}
