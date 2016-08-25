<?php

namespace app\modules\exchange\models;


use app\modules\cms\models\Reference;
use yii\db\ActiveQuery;

class City extends Reference
{
    const PARENTID = 1;

    public static function find()
    {
        $query = new CityQuery(get_called_class());
        $query->city();
        return $query;
    }

}

class CityQuery extends ActiveQuery
{
    public function city()
    {
        $this->andWhere(['parentId' => City::PARENTID]);

        return $this;
    }
}
