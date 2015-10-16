<?php

namespace app\modules\cms\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\cms\models\PageDoctor;

/**
 * PageDoctorSearch represents the model behind the search form about `app\modules\cms\models\PageDoctor`.
 */
class PageDoctorSearch extends PageDoctor
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'pageId', 'doctorId'], 'integer'],
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
        $query = PageDoctor::find();

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
            'pageId' => $this->pageId,
            'doctorId' => $this->doctorId,
        ]);

        return $dataProvider;
    }
}
