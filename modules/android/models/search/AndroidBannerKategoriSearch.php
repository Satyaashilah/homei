<?php

namespace app\modules\android\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\android\models\AndroidBannerKategori;

/**
 * AndroidBannerKategoriSearch represents the model behind the search form about `app\modules\android\models\AndroidBannerKategori`.
 * Modified By Defri Indras
 */
class AndroidBannerKategoriSearch extends AndroidBannerKategori{
    /**
    * @inheritdoc
    */
    public function rules()
    {
        return [
            [['id', 'flag'], 'integer'],
            [['nama_kategori'], 'safe'],
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
        $query = AndroidBannerKategori::find();

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
            'id' => $this->id,
            'flag' => $this->flag,
        ]);

        $query->andFilterWhere(['like', 'nama_kategori', $this->nama_kategori]);

        return $dataProvider;
    }
}