<?php

return [
    //настройки почты
    'email'=>(object)[
        'from'=>'info@dc-asar.kz',//от кого
        'host' => 'mail.dc-asar.kz',//адрес smtp сервера
        'username' => 'info@dc-asar.kz',//email
        'password' => 'Self5$29',//пароль
        'port' => '465',//порт
        'encryption' => 'ssl',//метод шифрования
        'to'=>'dc-asar@mail.ru',
    ],
    'adminEmail' => 'admin@example.com',
    'user.passwordResetTokenExpire'=>(15*60),//15 минут,
    'cardSecretKey'=>'$@#eWRFE4rfw#WQ@',
    'cardDomen'=>'http://dc-asar.kz',
    'pageSize'=>9,
    'socShare'=>'<script type="text/javascript" src="//yastatic.net/share/share.js" charset="utf-8"></script><div class="yashare-auto-init" data-yashareL10n="ru" data-yashareType="small" data-yashareQuickServices="vkontakte,facebook,twitter,odnoklassniki" data-yashareTheme="counter"></div>',
];
