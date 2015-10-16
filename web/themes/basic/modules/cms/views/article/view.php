<?php
/**
 * @var $this \yii\web\View
 * @var $item \app\modules\cms\models\Article
 */
$this->title = $item->title;
$this->params['breadcrumbs']=[
  ['label'=>$item->typeView,'url'=>['/cms/article/list','type'=>$type]],
    $this->title
];
?>
<h1><?=$item->title?></h1>
<small><?=\Yii::$app->formatter->asDate(strtotime($item->dateCreate))?></small><br/>
    <img src="<?= $item->image->resize('640x480') ?>" alt=""/>
<div class="clearfix"></div>
<?=$item->description?>