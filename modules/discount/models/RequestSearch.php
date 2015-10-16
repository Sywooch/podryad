<?php

namespace app\modules\discount\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\discount\models\Request;

/**
 * RequestSearch represents the model behind the search form about `app\modules\discount\models\Request`.
 */
class RequestSearch extends Request
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'cityId','status','userId'], 'integer'],
            [['username', 'phone', 'email', 'dateCreate', 'dateActivate','status'], 'safe'],
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
        $query = Request::find()->with(['city']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=>[
                'defaultOrder'=>[
                    'status'=>SORT_ASC
                ]
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'cityId' => $this->cityId,
            'dateCreate' => $this->dateCreate,
            'dateActivate' => $this->dateActivate,
            'status'=>$this->status,
            'userId'=>$this->userId,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'email', $this->email]);

        return $dataProvider;
    }
}
