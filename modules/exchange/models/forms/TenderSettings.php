<?php

namespace app\modules\exchange\models\forms;


use app\modules\cms\models\Settings;
use yii\base\Model;

class TenderSettings extends Model
{
    private $module = 'tender';
    public $metaKeywords;
    public $metaDescription;
    public $newsMetaKeywords;
    public $newsMetaDescription;

    public function rules()
    {
        return [
          [
              ['metaKeywords','metaDescription','newsMetaKeywords','newsMetaDescription'],
              'safe'
          ]
        ];
    }

    public function attributeLabels()
    {
        return [
          'metaKeywords'=>'Мета ключевики для тендеров',
          'metaDescription'=>'Мета описание для тендеров',
          'newsMetaKeywords'=>'Мета ключевики для новостей',
          'newsMetaDescription'=>'Мета описание для новостей',
        ];
    }

    public function init()
    {
        $this->metaKeywords = Settings::get($this->module,'metaKeywords');
        $this->newsMetaKeywords = Settings::get('news','metaKeywords');
        $this->metaDescription = Settings::get($this->module, 'metaDescription');
        $this->newsMetaDescription = Settings::get('news', 'metaDescription');
    }

    public function save()
    {
        Settings::set($this->module,'metaKeywords',$this->metaKeywords);
        Settings::set('news','metaKeywords',$this->newsMetaKeywords);
        Settings::set($this->module,'metaDescription',$this->metaDescription);
        Settings::set('news','metaDescription',$this->newsMetaDescription);
    }

}