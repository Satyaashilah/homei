<?php

namespace app\modules\blog\models;

use Yii;
use \app\modules\blog\models\base\Kategori as BaseKategori;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "blog_kategori".
 * Modified by Defri Indra M
 */
class Kategori extends BaseKategori
{
    static function getSelectizeList()
    {
        return ArrayHelper::map(
            self::find()
                ->select('id, nama_kategori as name')
                ->asArray()
                ->all(),
            'id',
            'name'
        );
    }

    // find random post from this category
    public static function findRandomPost($limit = 5, $dataProvider = true)
    {
        $query = self::find()
            ->joinWith('postKategoris')
            ->joinWith('postKategoris.post')
            ->where(['blog_post.flag' => 1])
            ->orderBy('RAND()')
            ->limit($limit);

        if ($dataProvider) return $query;
        return $query->all();
    }

    // find 5 last post from this category
    public static function findLastPost($limit = 5, $dataProvider = true)
    {
        $query = self::find()
            ->joinWith('postKategoris')
            ->joinWith('postKategoris.post')
            ->where(['blog_post.flag' => 1])
            ->orderBy('blog_post.created_at DESC')
            ->limit($limit);

        if ($dataProvider) return $query;
        return $query->all();
    }

    // find 5 popular post from this category
    public static function findPopularPost($limit = 5, $dataProvider = true)
    {
        $query = self::find()
            ->joinWith('postKategoris')
            ->joinWith('postKategoris.post')
            ->where(['blog_post.flag' => 1])
            ->orderBy('blog_post.view DESC')
            ->limit($limit);

        if ($dataProvider) return $query;
        return $query->all();
    }
}
