<?php
/** @var $this \yii\web\View */
/** @var $modelList \app\modules\exchange\models\Projecthouse[] */

use \app\modules\cms\models\Settings;
use yii\helpers\Url;
use yii\helpers\Html;

$this->title = Settings::get('projectHouse-index','title');

$metaDescription = Settings::get('projectHouse-index','metaDescription');
$metaKeywords = Settings::get('projectHouse-index','metaKeywords');

$this->params['breadcrumbs']['label'] = $this->title;

$this->registerMetaTag(['name'=>'description','content'=>$metaDescription]);
$this->registerMetaTag(['name'=>'description','content'=>$metaKeywords]);
?>
<main class="main">
    <section class="project-house">
        <h1 class="project-house__title"><?= $this->title?></h1>
        <div class="project-house__description">
            <?=Settings::get('projectHouse-index','seoText')?>
        </div>
        <?php if($modelList):?>
        <ul class="project-house__list">
            <?php foreach($modelList as $key=>$projectHouse):?>
            <li class="project-house__item">
                <div class="project-house__content">

                    <img src="<?=$projectHouse->image->imageSrc('200x150')?>" alt="<?=$projectHouse->title?> <?=$projectHouse->id?>" class="project-house__item-image">

                    <div class="project-house__item-title">
                        <?=$projectHouse->title?>
                    </div>
                    <div class="project-house__item-description">
                        <?=Html::encode($projectHouse->description)?>
                    </div>
                </div>
                <div class="project-house__linklist">
                    <div class="project-house__linklist-title">Скачать этот проект бесплатно с:</div>
                    <ul class="project-house__linklist-list">
                        <li class="project-house__linklist-item">
                            <a href="<?=$projectHouse->yandexDisk?>" class="project-house__house__linklist-a" target="_blank" rel="nofollow">Yandex Disk</a>
                        </li>
                        <li class="project-house__linklist-item">
                            <a href="<?=$projectHouse->googleDisk?>" class="project-house__house__linklist-a"
                               target="_blank" rel="nofollow">OneDrive</a>
                        </li>
                        <li class="project-house__linklist-item">
                            <a href="<?=$projectHouse->skyDrive?>" class="project-house__house__linklist-a"
                               target="_blank" rel="nofollow">Skydrive</a>
                        </li>
                    </ul>
                </div>
            </li>
            <?php endforeach?>

        </ul>
        <?php endif?>
    </section>
    <?= $this->render('//layouts/_sidebar') ?>
</main>

