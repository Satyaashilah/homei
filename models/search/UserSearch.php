<?php

namespace app\models\search;

use app\models\User;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * UserSearch represents the model behind the search form about `app\models\User`.
 */
class UserSearch extends User
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['role_id', 'username', 'password', 'name', 'photo_url', 'last_login', 'last_logout'], 'safe'],
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
        $query = User::find()->active()->joinRole();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            // default sort is by registered_at
            'sort' => [
                'defaultOrder' => [
                    'registered_at' => SORT_ASC,
                ],
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'user.id' => $this->id,
            'user.last_login' => $this->last_login,
            'user.last_logout' => $this->last_logout,
        ]);

        $query->andFilterWhere(['like', 'user.username', $this->username])
            ->andFilterWhere(['like', 'user.password', $this->password])
            ->andFilterWhere(['like', 'user.name', $this->name])
            ->andFilterWhere(['like', 'role.name', $this->role_id])
            ->andFilterWhere(['like', 'user.photo_url', $this->photo_url]);
        return $dataProvider;
    }
}
