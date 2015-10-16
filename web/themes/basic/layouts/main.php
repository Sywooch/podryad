<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>

<?php $this->beginBody() ?>
        <?php
            NavBar::begin([
                'brandLabel' => Yii::$app->name,
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => [
                    ['label'=>'Отзывы','url'=>['/cms/reviews/index']],
                    ['label'=>'Статьи','url'=>['/cms/article/list','type'=>'article']],
                    ['label'=>'Новости','url'=>['/cms/article/list','type'=>'news']],
                    ['label'=>'Акции','url'=>['/cms/article/list','type'=>'stock']],
                ],
            ]);
            NavBar::end();
        ?>
<br/><br/><br/>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="panel panel-success">
                        <div class="panel-heading">Каталог</div>
                        <div class="panel-body">
                            <ul class="nav nav-pills nav-stacked">
                                <?php foreach(\app\modules\store\models\Category::getNavigationData() as $item):?>
                                <li>
                                    <?=Html::a(
                                        Html::img($item->image->resize('33x30')).
                                        ' '.$item->title,
                                        $item->path
                                    )?>
                                </li>
                                <?php endforeach?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <?php if(Yii::$app->session->hasFlash('success')):?>
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <?=Yii::$app->session->getFlash('success')?>
                        </div>
                    <?php endif;?>
                    <?= Breadcrumbs::widget([
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                    ]) ?>

                    <?= $content ?>
                </div>
            </div>
        </div>

    <!-- footer class="footer">
        <div class="container">
            <p class="pull-left">&copy; My Company <?= date('Y') ?></p>
            <p class="pull-right"><?= Yii::powered() ?></p>
        </div>
    </footer -->

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
