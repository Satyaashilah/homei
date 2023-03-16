<?php

namespace app\modules\accesslog\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\accesslog\models\AccessLog;

/**
 * AccessLogSearch represents the model behind the search form about `app\modules\accesslog\models\AccessLog`.
 * Modified By Defri Indras
 */
class AccessLogSearch extends AccessLog
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id'], 'integer'],
            [['type', 'username', 'role', 'path', 'request', 'response', 'method', 'ip', 'created_at'], 'safe'],
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
        $query = AccessLog::find()->orderBy(['created_at' => SORT_DESC]);

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
            'user_id' => $this->user_id,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'role', $this->role])
            ->andFilterWhere(['like', 'path', $this->path])
            ->andFilterWhere(['like', 'request', $this->request])
            ->andFilterWhere(['like', 'response', $this->response])
            ->andFilterWhere(['like', 'method', $this->method])
            ->andFilterWhere(['like', 'ip', $this->ip]);

        return $dataProvider;
    }
}
