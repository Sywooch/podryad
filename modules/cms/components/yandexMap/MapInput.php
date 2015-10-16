<?php

namespace app\modules\cms\components\yandexMap;

/**
 * This is just an example.
 */
class MapInput extends \yii\base\Widget
{
    public $model;
    public $attribute;
    public $options=[
        'class'=>'form-control'
    ];

    public function run()
    {
        $view = $this->getView();
        IvphpanInputAsset::register($view);
        $options = $this->options;
        $options['id'] = 'ivphpanYandexMapCords';
        return $this->render('mapInput',[
            'model'=>$this->model,
            'attribute'=>$this->attribute,
            'options'=>$options,
        ]);
    }

}
