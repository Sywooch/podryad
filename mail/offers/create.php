<?php
/**
 * Created by PhpStorm.
 * User: ivphpan
 * Date: 27.10.15
 * Time: 17:52
 * @var $model \app\modules\exchange\models\Offers
 * @var $subject string
 *
 */
$link = \yii\helpers\Url::to(['/exchange/tender/view', 'id' => $model->tender->id], true);
?>
<table width="616px" cellpadding="0" cellspacing="0" style="border-collapse:collapse; border:none;margin:0 auto;" 

border="0">
<tbody>
<tr>
	<td width="100%" height="10" style="text-align:center;">
		<a href="http://podryad.kz/"target="_blank"><img 

src="http://podryad.kz/themes/podryad/static/images/logo_ras.jpg" alt="podryad.kz" width="95px" height="114px">
	</td>
</tr>
<tr>
	<td style=" padding: 20px; ">
		<p style=" color:#3f3f3f;font-family:Tahoma;font-size:14px; margin-bottom:20px ">
			Здравствуйте, <?=$model->tender->user->title?>!
		</p>
		<p style=" color:#3f3f3f;font-size:14px; margin:0;font-family:Tahoma; margin-bottom:8px ">
			Вам поступило предложение на выполнение объёма работ, описанного  
		</p>
		<p style=" color:#3f3f3f;font-size:14px; margin:0;font-family:Tahoma; margin-bottom:8px ">
			в Вашем тендере   <a href="<?=$link?>"><?=$model->tender->title?></a>.
		</p>
                <p style=" color:#3f3f3f;font-size:14px; margin:0; font-family:Tahoma; margin-bottom:8px">
			Для подробного просмотра предложения, пожалуйста, пройдите по ссылке 
		</p>
                <p style=" color:#3f3f3f;font-size:14px; margin:0; font-family:Tahoma; margin-bottom:20px">
			на страничку тендера. 
		</p>
		<p style=" color:#3f3f3f;font-size:14px; margin:0; font-family:Tahoma; margin-bottom:10px">
			С уважением,
		</p>
		<p style=" color:#3f3f3f;font-size:14px; margin:0;font-family:Tahoma; margin-bottom:20px ">
			команда podryad.kz
		</p>
	</td>
</tr>
</tbody>
</table>