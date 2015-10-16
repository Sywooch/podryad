<?php
/**
 * Created by PhpStorm.
 * User: ivphpan
 * Date: 16.10.15
 * Time: 12:36
 */

namespace app\modules\cms\models\form;


use app\modules\cms\models\User;
use yii\base\Model;

class RemindUser extends Model{

    public $username = '';

    public function rules()
    {
        return [
            [['username'],'required'],
            [['username'],'email'],
            [['username'],'checkUsername'],
        ];
    }

    public function checkUsername()
    {
        $model = User::findOne(['username'=>$this->username]);
        if(!$model)
        {
            return $this->addError('username','Вы ввели неверное имя пользователя!');
        }
    }

    public function attributeLabels(){
        return [
            'username'=>'Email',
        ];
    }

    public function send()
    {
        /** @var  $model User*/
        $model = User::findOne(['username'=>$this->username]);
        $model->generatePasswordResetToken();
        $model->save(false,['password_reset_token']);
        return \Yii::$app->mailer->compose('user/remind',['model'=>$model,'subject'=> \Yii::$app->params['subjects']['user.remind']])
            ->setSubject(\Yii::$app->params['subjects']['user.remind'])
            ->setFrom(\Yii::$app->params['email']->from)
            ->setTo($this->username)
            ->send();
    }

}