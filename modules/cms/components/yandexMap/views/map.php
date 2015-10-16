<?php
    /* @var $this \yii\web\View */
?>
<div class="b-ivphpan-map" data-cords="<?=$cords?>">

    <div id="ivphpanMap" style="height: 260px;">

    </div>

</div>


<?php
if($points)
{
    $jsCode = 'ivphpanYandexMap.cords='.$points[0]['cords'].';'."\r\n";
    foreach($points as $point)
    {
        $jsCode .= 'ivphpanYandexMap.addPoint('.$point['cords'].',"'.$point['iconContent'].'");'."\r\n";
    }
    $jsCode.='ivphpanYandexMap.setEvent("panTo");'."\r\n";
    $jsCode.='ivphpanYandexMap.setEvent("drawPoints");'."\r\n";
    $this->registerJs($jsCode);
}
?>