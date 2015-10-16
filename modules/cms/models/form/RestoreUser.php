<?php
/**
 * Created by PhpStorm.
 * User: ivphpan
 * Date: 16.10.15
 * Time: 14:07
 */

namespace app\modules\cms\models\form;


use app\models\LoginForm;
use app\modules\cms\models\User;
use yii\base\Model;

/**
 * Class RestoreUser
 * @package app\modules\cms\models\form
 *
 * @var $user User
 */
class RestoreUser extends Model{

    public $password;
    public $password2;
    public $user;

    public function rules()
    {
        return [
            [['password','password2'],'required'],
            [['password2'],'compare', 'compareAttribute' => 'password'],
        ];
    }

    public function change()
    {
        $this->user->password = $this->password;
        $this->user->password_reset_token = '';
        $result = $this->user->save(true, ['password', 'password_reset_token']);

        $login = new LoginForm();
        $login->username = $this->user->username;
        $login->password = $this->password2;
        $login->login();

        return $result;
    }

    public function attributeLabels()
    {
        return [
          'password'=>'Пароль',
          'password2'=>'Повтороить пароль',
        ];
    }
}