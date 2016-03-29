<?php
/**
 * Created by PhpStorm.
 * User: ivphpan
 * Date: 20.10.15
 * Time: 15:57
 * @var $this \yii\web\View
 * @var $page \app\modules\cms\models\Page
 */

$this->title = $page->metaTitle ? $page->metaTitle : $page->title;
$this->registerMetaTag(['description'=> $page->metaDescription]);
$this->registerMetaTag(['keywords'=>$page->metaKeywords]);
$this->registerMetaTag(['name' => 'og:title', 'content' => $this->title]);
$this->registerMetaTag(['name' => 'og:description', 'content' => $page->metaDescription]);
$this->registerMetaTag(['name' => 'twitter:description', 'content' => $page->metaDescription]);
$this->params['breadcrumbs'] = [
    $page->title
];

?>
<main class="main">
    <?=$page->description?>
    <?= $this->render('//layouts/_sidebar') ?>
</main>
