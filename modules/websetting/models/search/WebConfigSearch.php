<?php

namespace app\modules\websetting\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\websetting\models\WebConfig;

/**
 * WebConfigSearch represents the model behind the search form about `app\modules\websetting\models\WebConfig`.
 * Modified By Defri Indras
 */
class WebConfigSearch extends WebConfig
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'group_id', 'active'], 'integer'],
            [['name', 'value', 'default'], 'safe'],
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
        $query = WebConfig::find()
            ->leftJoin('web_config_group', 'web_config_group.id = web_config.group_id')
            ->orderBy(['web_config_group.name' => SORT_ASC]);

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
            'web_config_group.id' => $this->id,
            'web_config_group.group_id' => $this->group_id,
            'web_config_group.active' => $this->active,
        ]);

        $query->andFilterWhere(
            [
                'or',
                ['like', 'web_config_group.name', $this->name],
                ['like', 'web_config.name', $this->name],
            ]
        )
            ->andFilterWhere(['like', 'web_config_group.value', $this->value])
            ->andFilterWhere(['like', 'web_config_group.default', $this->default]);

        return $dataProvider;
    }
}
