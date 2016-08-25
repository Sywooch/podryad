<?php

namespace app\modules\exchange\models;

use app\modules\cms\models\Settings;
use app\modules\cms\models\User;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\exchange\models\Contactor;
use yii\db\ActiveQuery;
use yii\helpers\ArrayHelper;

/**
 * ContractorSearch represents the model behind the search form about `app\modules\exchange\models\Contactor`.
 */
class ContractorSearch extends Contactor
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['username', 'password', 'auth_key', 'password_reset_token', 'dateCreate'], 'safe'],
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
        $query = Contactor::find()->innerJoinWith(['assignment'])->joinWith([
            'profile' => function (ActiveQuery $subQuery){
                $subQuery->with(['city', 'image']);
                $subQuery->joinWith(['cityLists as cityList', 'specializations as specializationList']);
            },
        ]);
        $query->where(['item_name' => User::ROLE_CONTRACTOR]);

        if(!empty($params['city']))
        {
            $query->andWhere(['cityList.alias'=>$params['city']]);
        }

        if (!empty($params['specialization'])) {
            $childrens = $params['specialization']->childrens();
            if(sizeof($childrens)>0)
            {
                $ids = array_keys(ArrayHelper::map($childrens, 'id', 'id'));
            }else{
                $ids = $params['specialization']->id;
            }
            $query->andWhere(['specializationList.id' => $ids]);
        }

        $orderSettingsData = Settings::get('exchange', 'contractorOrder', true);
        $currentDate = date('d.m.Y');
        if ($orderSettingsData) {
            if (substr_count($orderSettingsData, '@')) {
                list($dateOrder, $allUserIdList) = explode('@', $orderSettingsData);
                if ($dateOrder != $currentDate) {
                    $allUserIdList = $this->getRandomIds();
                    Settings::set('exchange', 'contractorOrder', $currentDate . '@' . $allUserIdList, true);
                }
            }
        } else {
            $allUserIdList = $this->getRandomIds();
            Settings::set('exchange', 'contractorOrder', $currentDate . '@' . $allUserIdList, true);
        }
        $contractorSort = new \yii\db\Expression('FIND_IN_SET(iv_user.id,:userList)');
        $query->addParams([':userList' => $allUserIdList]);
        $query->orderBy([$contractorSort]);
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination'=>false,
        ]);

        return $dataProvider;
    }

    private function getRandomIds()
    {
        $orderIdsList = ArrayHelper::map(Contactor::find()->orderBy('rand()')->all(), 'id', 'id');

        return implode(',', $orderIdsList);
    }
}
