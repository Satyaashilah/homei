<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MasterMaterial;

/**
 * MasterMaterialSearch represents the model behind the search form about `app\models\MasterMaterial`.
 * Modified By Defri Indras
 */
class MasterMaterialSearch extends MasterMaterial{
    /**
    * @inheritdoc
    */
    public function rules()
    {
        return [
            [['id', 'id_satuan', 'flag'], 'integer'],
            [['nama', 'deskripsi'], 'safe'],
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
        $query = MasterMaterial::find();

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
            'id_satuan' => $this->id_satuan,
            'flag' => $this->flag,
        ]);

        $query->andFilterWhere(['like', 'nama', $this->nama])
            ->andFilterWhere(['like', 'deskripsi', $this->deskripsi]);

        return $dataProvider;
    }
}