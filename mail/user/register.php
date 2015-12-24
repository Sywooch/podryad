<?php
/**
 * @var $model \app\modules\cms\models\User
 */
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
			Уважаемый пользователь,
		</p>
		<p style=" color:#3f3f3f;font-size:14px; margin:0;font-family:Tahoma; margin-bottom:8px ">
			благодарим Вас за регистрацию на сайте Podryad.kz!
		</p>
		<p style=" color:#3f3f3f;font-size:14px; margin:0;font-family:Tahoma; margin-bottom:8px ">
			Пожалуйста, сохраните Ваши регистрационные данные и никому их не передавайте:
		</p>
                <p style=" color:#3f3f3f;font-size:14px; margin:0; font-family:Tahoma; margin-bottom:8px">
			<b>E-mail:</b> <?=$model->username?>;
		</p>
                <p style=" color:#3f3f3f;font-size:14px; margin:0; font-family:Tahoma; margin-bottom:8px">
			<b>Пароль:</b>  <?= $model->password2 ?>
                <p style=" color:#3f3f3f;font-size:14px; margin:0;font-family:Tahoma; margin-bottom:20px ">
			Желаем Вам приятного пользования нашим сервисом!
		
		</p>
		<p style=" color:#3f3f3f;font-size:14px; margin:0; font-family:Tahoma; margin-bottom:10px">
			С уважением,
		</p>
		<p style=" color:#3f3f3f;font-size:14px; margin:0;font-family:Tahoma; margin-bottom:20px ">
			команда podryad.kz
		</p>
	</td>
</tr>
<tr>
	<td>
		<a href="http://podryad.kz/" target="_blank" style=" background: linear-gradient(to bottom,#1c98ca 0%,#1882be 100%); background: -webkit-linear-gradient(top,#1c98ca 0%,#1882be 100%); border-radius: 3px; box-shadow: inset 0 1px 0 rgba(255,255,255,.5); color: #ffd200!important; display: block; font-family: calibri; font-size: 1.125em; text-decoration: none; text-shadow: 0 1px 0 rgba(0,0,0,.6); text-transform: uppercase; width: 150px; text-align: center; font-weight: bold; padding: 14px 0; margin: 0 auto;"> ПЕРЕЙТИ НА сайт</a>
	</td>
</tr>
</tbody>
</table>