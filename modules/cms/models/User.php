<?php

namespace app\modules\cms\models;

use app\models\LoginForm;
use Yii;
use yii\base\NotSupportedException;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\base\Security;
use yii\web\IdentityInterface;
/**
 * This is the model class for table "tbl_user".
 *
 * @property string $userid
 * @property string $username
 * @property string $password
 * @property string $password2
 * @property string $dateCreate
 * @property integer $agree
 * @property Profile $profile
 * @property AuthAssignment $assignment
 */
class User extends ActiveRecord  implements IdentityInterface
{
    const ROLE_ADMIN = 'admin';
    const ROLE_MANAGER = 'manager';
    const ROLE_CUSTOMER = 'customer';
    const ROLE_CONTRACTOR = 'contractor';
    public $password2;
    public $crib;
    public $agree;
    public $type;
    /**1
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password', 'agree'], 'required','on'=>'create'],
            ['username','email'],
            ['username','unique'],
            [['username', 'password'], 'string', 'max' => 100],
            [['username','password','password2'],'required','on'=>'client.create'],
            ['password2','compare','compareAttribute'=>'password','on'=>'client.create'],
            [['role','password','password2','dateCreate'],'safe'],
            [['role'],'default','value'=>$this->isNewRecord ? '' : $this->role],
            ['crib','safe','on'=>'user.crib'],
            ['crib','checkBalance','on'=>'user.crib'],
        ];
    }

    public function checkBalance($attr)
    {
        $value = $this->{$attr};
        $balance = $this->profile->balance;
        if($value>$balance)
            $this->addError ($attr,'Вы пытаетесь списать сумму больше вашего баланса!');
    }
    /**
     * @inheritdoc
     */
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
            'type' => 'Тип',
        ];
    }
    /** INCLUDE USER LOGIN VALIDATION FUNCTIONS**/
    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * @inheritdoc
     */
    /* modified */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    /* removed
        public static function findIdentityByAccessToken($token)
        {
            throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
        }
    */
    /**
     * Finds user by username
     *
     * @param  string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    /**
     * Finds user by password reset token
     *
     * @param  string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        $expire = \Yii::$app->params['user.passwordResetTokenExpire'];
        $parts = explode('_', $token);
        $timestamp = (int)end($parts);
        if ($timestamp + $expire < time()) {
            // token expired
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token
        ]);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param  string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        $security = new Security();
        return $security->validatePassword($password,$this->password);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $security = new Security();
        $this->password = $security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $security = new Security();
        $this->auth_key = $security->generateRandomKey();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = \Yii::$app->security->generateRandomString();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    /** EXTENSION MOVIE **/

    public static function getRolesDropdown()
    {
        return ArrayHelper::map(Yii::$app->authManager->getRoles(),'name','description');
    }

    public function beforeSave($insert=true)
    {
        if(!$this->isNewRecord && $this->role)
        {
            Yii::$app->authManager->revokeAll($this->id);
        }

        if(!empty($this->password))
            $this->setPassword($this->password);
        else
            $this->password = $this->oldAttributes['password'];

        $this->generateAuthKey();
        return parent::beforeSave($insert);
    }

    public function afterSave($insert=true,$changedAttributes)
    {
        if($this->role)
        {
            $auth = Yii::$app->authManager;
            $role = $auth->getRole($this->role);
            $auth->assign($role,$this->id);
        }

        return parent::afterSave($insert,$changedAttributes);
    }

    public static function getDropDown()
    {
        $data = self::find()->orderBy('username')->all();
        return ArrayHelper::map($data,'id','username');
    }

    public function getProfile()
    {
        return $this->hasOne(Profile::className(),['userId'=>'id']);
    }
    
    protected $_role;

    public function getRole()
    {
        if(!empty($this->_role))
            return $this->_role;
        
        $roles = Yii::$app->authManager->getRolesByUser($this->id);
        if(empty($roles))
            return '';
        
        $roles = array_keys($roles);
        return array_shift($roles);
    }
    
    public function setRole($value)
    {
        $this->_role = $value;
    }
    
    public function crib()
    {
        $balanceModel = new BalanceHistory;
        $balanceModel->id = md5($this->id.''.time());
        $balanceModel->type = BalanceHistory::TYPE_REMOVE;
        $balanceModel->userId = $this->id;
        $balanceModel->sum = $this->crib;
        $balanceModel->date = date(DATE_FORMAT_DB);
        $balanceModel->save();
        
        $balance = $balanceModel->getBalanceById($this->id);
        $this->profile->updateBalance();
    }

    /**
     * @param $profile Profile
     * @return bool
     */
    public function register($profile,$register=0)
    {
        $this->password2 = $this->password;
        $userRegister = $this->save();
        $profile->userId = $this->id;
        $profileRegister = $profile->save();

        Yii::$app->db->createCommand('DELETE FROM {{%user_specialization}} WHERE userId='.$this->id)->execute();
        foreach($profile->specialization as $specialiationId)
        {
            $model = Reference::findOne($specialiationId);
            $profile->link('specializations',$model);
        }

        if($register)
        {
            $this->emailSend();
            $this->emailSend(1);
        }

        $login = new LoginForm();
        $login->username = $this->username;
        $login->password = $this->password2;
        $login->login();

        return $userRegister && $profileRegister;
    }

    public function emailSend($type=0)
    {
        $email = \Yii::$app->params['email'];
        \Yii::$app->mailer->compose(
            $type ? 'user/new' : 'user/register',
            ['model' => $this])
            ->setFrom($email->from)
            ->setTo($type ? $email->to : $this->username)
            ->setSubject($type ? Yii::$app->params['subjects']['user.admin.register'] : Yii::$app->params['subjects']['user.register'])
            ->send();
    }

    public function beforeDelete()
    {
        $this->profile->delete();
        return parent::beforeDelete();
    }

    public function getAssignment()
    {
        return $this->hasOne(AuthAssignment::className(),['user_id'=>'id']);
    }

    public function getTitle()
    {
        return $this->profile->fio;
//        return $this->profile->company ? $this->profile->company . ', ' . $this->profile->fio : $this->profile->fio;
    }

    static public function typeDropdown()
    {
        return [
            User::ROLE_CONTRACTOR => 'Подрядчик',
            User::ROLE_CUSTOMER => 'Заказчик',
        ];
    }


    public function typeTitle()
    {
        $list = self::typeDropdown();
        if(!$this->assignment)
        {
            return null;
        }
        return !empty($list[$this->assignment->item_name]) ? $list[$this->assignment->item_name] : '';
    }
}