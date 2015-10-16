<?php

namespace app\modules\discount\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\discount\models\Category;

/**
 * CategorySearch represents the model behind the search form about `app\modules\discount\models\Category`.
 */
class CategorySearch extends Category
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'visible', 'parentId'], 'integer'],
            [['title', 'alias', 'description', 'metaKeywords', 'metaDescription', 'dateCreate'], 'safe'],
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
        $query = Category::find();

        $dataProvider = new ActiveDataProvider([
            'key'=>'id',
            'query' => $query,
            'pagination'=>['pageSize'=>100],
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
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'metaKeywords', $this->metaKeywords])
            ->andFilterWhere(['like', 'metaDescription', $this->metaDescription]);

        return $dataProvider;
    }
}
