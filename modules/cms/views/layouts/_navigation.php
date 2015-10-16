<?php
use yii\helpers\Url;

?>
<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li class="sidebar-search" style="display:none">
                <div class="input-group custom-search-form">
                    <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                </div>
                <!-- /input-group -->
            </li>

            <li>
                <a href="#"><i class="fa fa-wrench fa-fw"></i> CMS<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="<?= Url::to(['/cms/admin/page']) ?>">Страницы</a>
                    </li>
                    <li>
                        <a href="<?= Url::to(['/cms/admin/block']) ?>">Блоки</a>
                    </li>
                    <li>
                        <a href="<?= Url::to(['/cms/admin/user']) ?>">Пользователи</a>
                    </li>
                    <li>
                        <a href="<?= Url::to(['/cms/admin/article']) ?>">Статьи</a>
                    </li>
                    <li>
                        <a href="<?= Url::to(['/cms/admin/reference']) ?>">Справочники</a>
                    </li>
                    <li>
                        <a href="<?= Url::to(['/cms/admin/file']) ?>">Библиотека</a>
                    </li>
                    <li>
                        <a href="<?= Url::to(['/cms/admin/rate']) ?>">Рейтинг</a>
                    </li>
                    <!--                    <li>-->
                    <!--                        <a href="--><? //=Url::to(['/cms/admin/config'])?><!--">Настройки</a>-->
                    <!--                    </li>-->
                </ul>
                <!-- /.nav-second-level -->
            </li>

            <!-- li>
                <a href="#"><i class="fa fa-android fa-fw"></i> Каталог<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="<?= Url::to(['/store/admin/category']) ?>">Категории <i
                                class="badge"><?= \app\modules\store\models\Category::getCount() ?></i></a>
                    </li>
                    <li>
                        <a href="<?= Url::to(['/store/admin/manufacturer']) ?>">Производители <i
                                class="badge"><?= \app\modules\store\models\Manufacturer::getCount() ?></i></a>
                    </li>
                    <li>
                        <a href="<?= Url::to(['/store/admin/product']) ?>">Товары <i
                                class="badge"><?= \app\modules\store\models\Product::getCount() ?></i></a>
                    </li>
                   <li>
                       <a href="<?//= Url::to(['/store/admin/order']) ?>">Заказы <i class="badge"><?//= \app\modules\store\models\Order::getCount() ?></i></a>
                   </li>
                </ul>
            </li -->

            <!--li>
                <a href="#"><i class="fa fa-android fa-fw"></i>Персонал<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="<?= Url::to(['/directorBoard/admin/board']) ?>">Список</a>
                    </li>
                </ul>
            </li-->
            <li>
                <a href="#"><i class="fa fa-android fa-fw"></i>Форум<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="<?= Url::to(['/forum/admin/item']) ?>">Список</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>
<!-- /.navbar-static-side -->