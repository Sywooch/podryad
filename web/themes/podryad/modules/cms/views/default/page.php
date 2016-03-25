<?php
/**
 * Created by PhpStorm.
 * User: ivphpan
 * Date: 20.10.15
 * Time: 15:57
 * @var $this \yii\web\View
 * @var $page \app\modules\cms\models\Page
 */
$this->title = $page->title;
$this->registerMetaTag(['description'=>strip_tags($page->shortext(300,true))]);
$this->registerMetaTag(['keywords'=>$page->title]);

$this->params['breadcrumbs'] = [
    $page->title
];

?>
<main class="main">
    <?=$page->description?>
    <?= $this->render('//layouts/_sidebar') ?>
</main>
