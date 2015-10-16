<?php
namespace app\modules\cms\models\form;
use yii\base\Model;
use \Yii;
/**
 * Class PriceForm
 * @property \app\modules\cms\models\Price $price
 */
class PriceForm extends Model
{
    public $priceId;
    public $name;
    public $phone;
    public $date;
    public $section;

    public function rules()
    {
        return [
            [['name','phone','date','priceId','section'],'required'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name'=>'ФИО',
            'phone'=>'Телефон',
            'priceId'=>'Телефон',
            'date'=>'Дата записи',
            'section'=>'Отделение',
        ];
    }

    public function send()
    {
        $subject = 'Запись на приём "'.$this->price->obj->title.'" - '.Yii::$app->name;
        return Yii::$app->mailer->compose('cms/price',['model'=>$this,'subject'=>$subject])
            ->setFrom(Yii::$app->params['email']->from)
            ->setTo(Yii::$app->params['email']->to)
            ->setSubject($subject)
            ->send();
    }

    public function getPrice()
    {
        return \app\modules\cms\models\Price::findOne($this->priceId);
    }
}