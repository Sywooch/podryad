<?php
/**
 * @var $this \yii\web\View
 * @var $model \app\modules\exchange\models\Contactor
 * @var $specialization string
 * @var $specializationModel \app\modules\cms\models\Reference
 * @var $contactorList \app\modules\exchange\models\Contactor[]
 * @var $pages \yii\data\Pagination
 * @var $dataProvider \yii\data\ActiveDataProvider
 * @var $cityModel \app\modules\exchange\models\City
 * @var $seoModel \app\modules\cms\models\CustomSeo
 */

use yii\widgets\ListView;

$this->registerJsFile(
    $this->theme->getUrl('static/js/scroll/save.js'),
    ['depends'=>\yii\web\JqueryAsset::className()]
);

if($seoModel)
{
    $this->registerMetaTag(['name' => 'og:title', 'content' => $seoModel->title]);
    $this->registerMetaTag(['name' => 'og:description', 'content' => $seoModel->metaDescription]);
    $this->registerMetaTag(['name' => 'twitter:description', 'content' => $seoModel->metaDescription]);
    $this->registerMetaTag(['name'=>'keywords','content'=> $seoModel->metaKeywords]);
    $this->registerMetaTag(['name'=>'description','content'=> $seoModel->metaKeywords]);
}

$this->title = $seoModel->title ? $seoModel->title : $specializationModel->title;
$h1 = $seoModel->h1 ? $seoModel->h1 : $specializationModel->title;
$breadcrumbs = $specializationModel->breadcrumbs(['parentExclude' => true]);
if($cityModel)
{
    $breadcrumbs[sizeof($breadcrumbs)-1]['label'] .= ' - '.$cityModel->title;
    $h1 .= ' - '.$cityModel->title;
}
$this->params['breadcrumbs'] = $breadcrumbs;

?>
<main class="main">
    <section class="search-contractor-content">
        <h1 class="search-contractor-content__title"><?= $h1?></h1>
        <?=app\modules\exchange\widgets\Navigation::widget(['model'=> $specializationModel])?>
        <div class="search-contractor-results">
            <div class="seo-block">
                <div>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut excepturi quidem soluta tempora
                    voluptatem! At dolorum, exercitationem maiores minus quis repellat reprehenderit sapiente. A atque
                    cumque dolore eos officia perferendis!
                </div>
                <div>Ad animi aperiam cupiditate dicta dolor earum explicabo hic, id ipsam laborum nesciunt numquam
                    provident ratione sed sequi soluta voluptate? Consectetur dignissimos enim iste iure sequi!
                    Exercitationem modi perspiciatis provident!
                </div>
                <div>Architecto expedita fuga illum incidunt non. Ad architecto assumenda beatae distinctio, doloribus
                    ea esse, est eum expedita impedit inventore maiores minima natus officia perferendis possimus quae
                    quo reiciendis sapiente vero.
                </div>
            </div>
            <div class="search-contractor-results-list">
                <div class="search-contractor-results-list-item">
                    <?=ListView::widget([
                        'dataProvider'=>$dataProvider,
                        'itemView'=>'_contractor',
                        'itemOptions'=>[
                            'class'=>'contractor-block'
                        ],
                        'summary'=>'',
                    ])?>
                </div>
            </div>
        </div>
    </section>
</main>
