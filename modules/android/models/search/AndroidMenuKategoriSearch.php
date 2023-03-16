<?php

namespace app\modules\android\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\android\models\AndroidMenuKategori;

/**
 * AndroidMenuKategoriSearch represents the model behind the search form about `app\modules\android\models\AndroidMenuKategori`.
 * Modified By Defri Indras
 */
class AndroidMenuKategoriSearch extends AndroidMenuKategori
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'order', 'id_reference', 'flag', 'id_reference'], 'integer'],
            [['category_name', 'icon'], 'safe'],
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
        $query = AndroidMenuKategori::find();

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
            'order' => $this->order,
            'id_reference' => $this->id_reference,
            'flag' => $this->flag,
        ]);

        $query->andFilterWhere(['like', 'category_name', $this->category_name])
            ->andFilterWhere(['like', 'icon', $this->icon]);

        return $dataProvider;
    }
}
