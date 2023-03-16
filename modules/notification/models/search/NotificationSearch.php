<?php

namespace app\modules\notification\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\notification\models\Notification;

/**
 * NotificationSearch represents the model behind the search form about `app\modules\notification\models\Notification`.
 * Modified By Defri Indras
 */
class NotificationSearch extends Notification
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'read'], 'integer'],
            [['title', 'user_id', 'description', 'controller', 'android_route', 'params', 'created_at'], 'safe'],
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
        $query = Notification::find()->leftJoin('user', 'user.id=notification.user_id');

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
            'notification.id' => $this->id,
            'notification.read' => $this->read,
            'notification.created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'notification.title', $this->title])
            ->andFilterWhere(['like', 'user.name', $this->user_id])
            ->andFilterWhere(['like', 'notification.description', $this->description])
            ->andFilterWhere(['like', 'notification.controller', $this->controller])
            ->andFilterWhere(['like', 'notification.android_route', $this->android_route])
            ->andFilterWhere(['like', 'notification.params', $this->params]);

        return $dataProvider;
    }
}
