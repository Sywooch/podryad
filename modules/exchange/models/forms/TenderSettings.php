<?php

namespace app\modules\exchange\models\forms;


use app\modules\cms\models\Settings;
use yii\base\Model;

class TenderSettings extends Model
{
    private $module = 'tender';
    public $metaKeywords;
    public $metaDescription;

    public function rules()
    {
        return [
          [
              ['metaKeywords','metaDescription'],
              'safe'
          ]
        ];
    }

    public function attributeLabels()
    {
        return [
          'metaKeywords'=>'Ключевые слова',
          'metaDescription'=>'Описание',
        ];
    }

    public function init()
    {
        $this->metaKeywords = Settings::get($this->module,'metaKeywords');
        $this->metaDescription = Settings::get($this->module, 'metaDescription');
    }

    public function save()
    {
        Settings::set($this->module,'metaKeywords',$this->metaKeywords);
        Settings::set($this->module,'metaDescription',$this->metaDescription);
    }

}