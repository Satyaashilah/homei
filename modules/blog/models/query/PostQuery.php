<?php

namespace app\modules\blog\models\query;

class PostQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        return $this->andWhere(['blog_post.flag' => 1]);
    }
}
