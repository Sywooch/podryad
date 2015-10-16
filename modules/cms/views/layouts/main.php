<?php
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use app\assets\AdminAsset;
use yii\helpers\Url;

/* @var $this \yii\web\View */
/* @var $content string */

AdminAsset::register($this);
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

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

<div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?=Url::home()?>"><?=Yii::$app->name?> - административная часть</a>
        </div>
        <!-- /.navbar-header -->
        <?php if(!Yii::$app->user->isGuest):?>
        <ul class="nav navbar-top-links navbar-right">
            <li>
                <a href="#">
                    <i class="fa fa-user fa-fw"></i> <?=Yii::$app->user->identity->username?></i>
                </a>
                <!-- /.dropdown-user -->
            </li>
            <li>
                <a href="<?=Url::to(['/site/logout'])?>" data-method="post">
                    <i class="fa  fa-sign-out fa-ew"></i> Выход</i>
                </a>
                <!-- /.dropdown-user -->
            </li>
            <!-- /.dropdown -->
        </ul>
        <!-- /.navbar-top-links -->
        <?php endif?>

        <?php if(!Yii::$app->user->isGuest && Yii::$app->user->can('admin.nav')):?>
            <?=$this->render('_navigation')?>
        <?php endif;?>
    </nav>

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"><?=$this->title?></h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>

        <div class="row">
            <div class="col-md-12">
                <?php
                if(!empty($this->params['breadcrumbs']))
                    echo Breadcrumbs::widget([
                        'links'=>$this->params['breadcrumbs'],
                    ]);
                ?>
                <?=$content?>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<?php $this->endBody()?>
</body>

</html>
<?php $this->endPage()?>
