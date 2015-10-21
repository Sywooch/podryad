<?php
/**
 * Created by PhpStorm.
 * User: ivphpan
 * Date: 01.10.15
 * Time: 8:43
 */

namespace app\modules\cms\models\form;


use app\models\LoginForm;
use app\modules\cms\models\Profile;
use app\modules\cms\models\Reference;
use app\modules\cms\models\User;
use yii\base\Model;
use \Yii;
use yii\web\UploadedFile;

class RegisterForm extends Model{

    public $id;
    public $role;
    public $fio;
    public $phone;
    public $username;
    public $specialization=[];
    public $cityId;
    public $password;
    public $password2;
    public $agree;
    public $company;
    public $file;

    public function rules()
    {
        return [
            [['role','fio','phone','username','specialization','cityId','password','password2'],'required','on'=>User::ROLE_CONTRACTOR],
            [['role','fio','username','cityId','phone','password','password2'],'required','on'=>User::ROLE_CUSTOMER],
            ['username','email'],
            ['company','string'],
            ['username','unique','targetClass'=>User::className(),'targetAttribute'=>'username'],
            ['password2', 'compare', 'compareAttribute' => 'password'],
            ['cityId','required','message'=>'Вы не указали город!','isEmpty'=>function($value){
                return $value==0;
            }],
            ['agree','required','message'=>'Вы должны принять условия!','on'=>[User::ROLE_CONTRACTOR,User::ROLE_CUSTOMER],'isEmpty'=>function($value){
                return $value==0;
            }],
            ['file','file','skipOnEmpty'=>true],
            [['role', 'fio', 'phone','specialization', 'cityId'], 'required', 'on' => 'update'],
            [['password','password2'],'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'userid' => 'Userid',
            'username' => 'Email',
            'password' => 'Пароль',
            'password2' => 'Повторить пароль',
            'role' => 'Полномочия',
            'dateCreate' => 'Дата регистрации',
            'crib' => 'Сумма вывода',
            'agree' => 'Условия пользования сервисом',
            'cityId' => Yii::t('app', 'Город'),
            'phone' => Yii::t('app', 'Телефон'),
            'fio' => Yii::t('app', 'Ф.И.О'),
            'specialization' => Yii::t('app', 'Специализации'),
            'company' => Yii::t('app', 'Компания'),
        ];
    }

    /**
     * @return bool
     */
    public function register()
    {
        $user = new User();
        $user->attributes = $this->attributes;
        $userRegister = $user->save();

        $this->password2 = $this->password;
        $profile = new Profile();
        $profile->attributes = $this->attributes;
        $profile->userId = $user->id;
        $profileRegister = $profile->save();

        $user->emailSend();
        $user->emailSend(1);

        $login = new LoginForm();
        $login->username = $this->username;
        $login->password = $this->password2;
        $login->login();

        if ($this->scenario == User::ROLE_CONTRACTOR) {
            Yii::$app->db->createCommand('DELETE FROM {{%user_specialization}} WHERE userId=' . $user->id)->execute();
            foreach ($profile->specialization as $specialiationId) {
                $model = Reference::findOne($specialiationId);
                $profile->link('specializations', $model);
            }
        }

        $this->id = $user->id;

        return $userRegister && $profileRegister;
    }

    public function update($user,$profile)
    {
        $user->attributes = $this->attributes;
        $userRegister = $user->save(true,['password']);

        $this->password2 = $this->password;
        $profile->attributes = $this->attributes;
        $profile->userId = $user->id;
        $profileRegister = $profile->save();

        $this->file = UploadedFile::getInstance($this, 'file');
        if ($this->file) {

            if ($profile->image) {
                $profile->image->delete();
            }

            $image = new \app\modules\cms\models\Image();
            $image->model = $profile::className();
            $image->primaryKey = $profile->userId;
            $image->file = $this->file;
            $image->create();
        }

        if ($this->specialization) {
            Yii::$app->db->createCommand('DELETE FROM {{%user_specialization}} WHERE userId=' . $user->id)->execute();
            foreach ($profile->specialization as $specialiationId) {
                $model = Reference::findOne($specialiationId);
                $profile->link('specializations', $model);
            }
        }

        return $userRegister && $profileRegister;
    }

}