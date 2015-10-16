<?php

namespace app\modules\store\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\store\models\ModificatorCategory;

/**
 * ModificatorCategorySearch represents the model behind the search form about `app\modules\store\models\ModificatorCategory`.
 */
class ModificatorCategorySearch extends ModificatorCategory
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'productId', 'categoryId'], 'integer'],
            [['title', 'titleLink', 'alias', 'memo'], 'safe'],
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
        $query = ModificatorCategory::find();

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
            'productId' => $this->productId,
            'categoryId' => $this->categoryId,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'titleLink', $this->titleLink])
            ->andFilterWhere(['like', 'alias', $this->alias])
            ->andFilterWhere(['like', 'memo', $this->memo]);

        return $dataProvider;
    }
}
