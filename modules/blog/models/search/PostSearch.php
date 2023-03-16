<?php

namespace app\modules\blog\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\blog\models\Post;

/**
 * PostSearch represents the model behind the search form about `app\modules\blog\models\Post`.
 * Modified By Defri Indras
 */
class PostSearch extends Post
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'slug', 'image', 'title', 'tag', 'kilasan', 'content', 'id_author', 'created_at', 'updated_at'], 'safe'],
            [['view_count', 'flag', 'categories'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        // separate query for search
        $query = Post::find()->joinWith([
            'kategoris' => function ($query) {
                $query->from(['kategori' => 'blog_kategori']);
            }
        ])->orderBy('blog_post.created_at DESC');

        // condition user for search
        if (!\Yii::$app->user->identity->isSuperAdmin) {
            $query->where(['id_author' => Yii::$app->user->identity->id]);
        }


        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            // filter by category
            'kategori.id' => $this->categories,
            'view_count' => $this->view_count,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            // 'flag' => $this->flag,
        ]);

        $query->andFilterWhere(['like', 'id', $this->id])
            ->andFilterWhere(['like', 'slug', $this->slug])
            ->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'tag', $this->tag])
            ->andFilterWhere(['like', 'kilasan', $this->kilasan])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'id_author', $this->id_author]);

        $query->active();
        return $dataProvider;
    }
}
