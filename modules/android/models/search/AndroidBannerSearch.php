<?php

namespace app\modules\android\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\android\models\AndroidBanner;

/**
 * AndroidBannerSearch represents the model behind the search form about `app\modules\android\models\AndroidBanner`.
 * Modified By Defri Indras
 */
class AndroidBannerSearch extends AndroidBanner
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_route', 'id_kategori', 'gambar', 'judul', 'deskripsi', 'params'], 'safe'],
            [['order'], 'integer'],
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
        $query = AndroidBanner::find()
            ->leftJoin('android_banner_kategori', 'android_banner_kategori.id = android_banner.id_kategori')
            ->leftJoin('android_route', 'android_route.id = android_banner.id_route');

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
            'order' => $this->order,
        ]);

        $query->andFilterWhere(['like', 'android_banner.id', $this->id])
            ->andFilterWhere(['like', 'android_banner_kategori.nama_kategori', $this->id_kategori])
            ->andFilterWhere(['like', 'android_route.nama_route', $this->id_route])
            ->andFilterWhere(['like', 'gambar', $this->gambar])
            ->andFilterWhere(['like', 'judul', $this->judul])
            ->andFilterWhere(['like', 'deskripsi', $this->deskripsi])
            ->andFilterWhere(['like', 'params', $this->params]);

        return $dataProvider;
    }
}
