<?php

namespace app\modules\discount\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\discount\models\Partner;

/**
 * PartnerSearch represents the model behind the search form about `app\modules\discount\models\Partner`.
 */
class PartnerSearch extends Partner
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'visible', 'parentId'], 'integer'],
            [['title', 'alias', 'site', 'address', 'workTime', 'phones', 'description', 'metaKeywords', 'metaDescription', 'dateCreate'], 'safe'],
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
        $query = Partner::find();

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
            'dateCreate' => $this->dateCreate,
            'visible' => $this->visible,
            'parentId' => $this->parentId,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'alias', $this->alias])
            ->andFilterWhere(['like', 'site', $this->site])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'workTime', $this->workTime])
            ->andFilterWhere(['like', 'phones', $this->phones])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'metaKeywords', $this->metaKeywords])
            ->andFilterWhere(['like', 'metaDescription', $this->metaDescription]);

        return $dataProvider;
    }
}
