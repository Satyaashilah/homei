<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\WilayahKota;

/**
 * WilayahKotaSearch represents the model behind the search form of `app\models\WilayahKota`.
 */
class WilayahKotaSearch extends WilayahKota
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'provinsi_id', 'nama'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = WilayahKota::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere(['like', 'id', $this->id])
            ->andFilterWhere(['like', 'provinsi_id', $this->provinsi_id])
            ->andFilterWhere(['like', 'nama', $this->nama]);

        return $dataProvider;
    }
}
