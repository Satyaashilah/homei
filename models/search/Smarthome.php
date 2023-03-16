<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Smarthome as SmarthomeModel;

/**
* Smarthome represents the model behind the search form about `app\models\Smarthome`.
*/
class Smarthome extends SmarthomeModel
{
/**
* @inheritdoc
*/
public function rules()
{
return [
[['id', 'id_user', 'flag'], 'integer'],
            [['nama', 'suhu', 'kelembapan', 'tegangan', 'daya', 'ampere', 'daya_sebelumnya', 'ampere_sebelumnya', 'token'], 'safe'],
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
$query = SmarthomeModel::find();

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
            'id_user' => $this->id_user,
            'flag' => $this->flag,
        ]);

        $query->andFilterWhere(['like', 'nama', $this->nama])
            ->andFilterWhere(['like', 'suhu', $this->suhu])
            ->andFilterWhere(['like', 'kelembapan', $this->kelembapan])
            ->andFilterWhere(['like', 'tegangan', $this->tegangan])
            ->andFilterWhere(['like', 'daya', $this->daya])
            ->andFilterWhere(['like', 'ampere', $this->ampere])
            ->andFilterWhere(['like', 'daya_sebelumnya', $this->daya_sebelumnya])
            ->andFilterWhere(['like', 'ampere_sebelumnya', $this->ampere_sebelumnya])
            ->andFilterWhere(['like', 'token', $this->token]);

return $dataProvider;
}
}