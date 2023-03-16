<?php

namespace app\modules\android\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\android\models\AndroidRoute;

/**
 * AndroidRouteSearch represents the model behind the search form about `app\modules\android\models\AndroidRoute`.
 * Modified By Defri Indras
 */
class AndroidRouteSearch extends AndroidRoute
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'butuh_login', 'flag'], 'integer'],
            [['nama_route', 'params'], 'safe'],
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
        $query = AndroidRoute::find()->orderBy(['nama_route' => SORT_ASC]);

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
            'butuh_login' => $this->butuh_login,
            'flag' => $this->flag,
        ]);

        $query->andFilterWhere(['like', 'nama_route', $this->nama_route])
            ->andFilterWhere(['like', 'params', $this->params]);

        return $dataProvider;
    }
}
