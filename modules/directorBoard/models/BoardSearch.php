<?php

namespace app\modules\directorBoard\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\directorBoard\models\Board;

/**
 * BoardSearch represents the model behind the search form about `app\modules\directorBoard\models\Board`.
 */
class BoardSearch extends Board
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id','categoryId'], 'integer'],
            [['title', 'content', 'alias'], 'safe'],
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
        $query = Board::find();

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
            'categoryId' => $this->categoryId,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'alias', $this->alias]);

        return $dataProvider;
    }
}
