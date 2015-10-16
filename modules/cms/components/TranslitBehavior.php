<?php
namespace app\modules\cms\components;

use yii\base\Behavior;
use yii\db\ActiveRecord;

class TranslitBehavior extends Behavior{

    public $titleAttribute = 'title';
    public $attributes = ['alias'];

    public function events()
    {
        return [
          ActiveRecord::EVENT_BEFORE_VALIDATE=>'translit',
        ];
    }

    public function translit()
    {
        foreach($this->attributes as $attribute)
        {
            if(empty($this->owner->{$attribute}))
            {
                $this->owner->{$attribute} = Translit::str2url( $this->owner->{$this->titleAttribute} );
            }
        }
        return true;
    }

} 