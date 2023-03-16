<?php

namespace app\modules\android\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\android\models\AndroidMenu;

/**
 * AndroidMenuSearch represents the model behind the search form about `app\modules\android\models\AndroidMenu`.
 * Modified By Defri Indras
 */
class AndroidMenuSearch extends AndroidMenu
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_category', 'need_login', 'order'], 'integer'],
            [['name', 'label', 'type', 'icon', 'navigation', 'params', 'created_at'], 'safe'],
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
        $query = AndroidMenu::find()->orderBy(['created_at' => SORT_DESC]);

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
            'id_category' => $this->id_category,
            'need_login' => $this->need_login,
            'order' => $this->order,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'label', $this->label])
            ->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'icon', $this->icon])
            ->andFilterWhere(['like', 'navigation', $this->navigation])
            ->andFilterWhere(['like', 'params', $this->params]);

        return $dataProvider;
    }
}
