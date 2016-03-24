<?php
/**
 * Created by PhpStorm.
 * User: ivphpan
 * Date: 16.10.15
 * Time: 15:27
 * @var $tender \app\modules\exchange\models\Tender
 * @var $subject string
 */

use yii\helpers\Url;
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
			Здравствуйте!
		</p>
		<p style=" color:#3f3f3f;font-size:14px; margin:0;font-family:Tahoma; margin-bottom:8px ">
			Вас подрядили на выполнение объёма, описанного в тендере:
		</p>
		<p style=" color:#3f3f3f;font-size:14px; margin:0;font-family:Tahoma; margin-bottom:8px ">
			<a href="<?=Url::to(['/exchange/tender/view','id'=>$tender->id],true)?>"><?=$tender->title?></a>
		</p>
                <p style=" color:#3f3f3f;font-size:14px; margin:0; font-family:Tahoma; margin-bottom:8px">
			Пройдите по ссылке на страничку тендера, теперь Вам доступны контакты заказчика.
		</p>
                <p style=" color:#3f3f3f;font-size:14px; margin:0; font-family:Tahoma; margin-bottom:8px">
			Свяжитесь с ним и обсудите ваши дальнейшие совместные действия. 
		</p>
                <p style=" color:#3f3f3f;font-size:14px; margin:0; font-family:Tahoma; margin-bottom:20px">
			Удачных проектов!
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