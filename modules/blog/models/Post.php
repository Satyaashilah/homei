<?php

namespace app\modules\blog\models;

use \app\modules\blog\models\base\Post as BasePost;
use app\modules\blog\models\query\PostQuery;
use Faker\Provider\Uuid;
use Yii;

/**
 * This is the model class for table "blog_post".
 * Modified by Defri Indra M
 */
class Post extends BasePost
{
    // use traits
    use \app\traits\UploadFileTrait;

    // delete
    const SCENARIO_DELETE = 'delete';

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_DELETE] = ['id', 'flag'];
        return $scenarios;
    }

    // create temp variable for categories
    public $categories;

    // get all categories from this post
    public function getKategoris()
    {
        return $this->hasMany(Kategori::className(), ['id' => 'id_kategori'])
            ->viaTable('blog_post_kategori', ['id_post' => 'id']);
    }

    // get name of categories from this post
    public function getKategoriNames()
    {
        $kategoris = $this->getKategoris()->all();
        $kategoriNames = [];
        foreach ($kategoris as $kategori) {
            $kategoriNames[] = $kategori->nama;
        }
        return implode(', ', $kategoriNames);
    }

    // function update view count
    public function updateViewCount()
    {
        $this->view_count = $this->view_count + 1;
        $this->save();
    }

    // function set categories for this post
    public function setKategori($kategoriData)
    {
        $this->unlinkAll('kategoris', true);
        if ($kategoriData) {
            foreach ($kategoriData as $kategori) {
                $new = new PostKategori();
                // id from uuid
                $new->id = Uuid::uuid();
                $new->id_post = $this->id;
                $new->id_kategori = $kategori;
                $new->save();
            }
        }
    }

    public function getUploadedPath()
    {
        return "blog/post/thumbnail/";
    }

    // validate is author or not
    public function isAuthor()
    {
        return $this->id_author == Yii::$app->user->identity->id;
    }

    // change callable function find
    public static function find()
    {
        return new PostQuery(get_called_class());
    }
}
