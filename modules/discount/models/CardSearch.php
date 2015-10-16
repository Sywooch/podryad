<?php

namespace app\modules\discount\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\discount\models\Card;

/**
 * CardSearch represents the model behind the search form about `app\modules\discount\models\Card`.
 */
class CardSearch extends Card
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status', 'userId','type'], 'integer'],
            [['cvcode',  'datePrint', 'dateActivate','number'], 'safe'],
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
        $query = Card::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=>['defaultOrder'=>['id'=>SORT_DESC]],
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
//            'dateCreate' => $this->dateCreate,
            'datePrint' => $this->datePrint,
            'dateActivate' => $this->dateActivate,
            'status' => $this->status,
            'userId' => $this->userId,
            'type' => $this->type,
        ]);

        $query->andFilterWhere(['like', 'cvcode', $this->cvcode]);

        return $dataProvider;
    }
}
