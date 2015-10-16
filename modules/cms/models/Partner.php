<?php

namespace app\modules\cms\models;

use Yii;
use app\modules\cms\models\User;
/**
 * This is the model class for table "{{%user_partner}}".
 *
 * @property integer $userId
 * @property integer $partnerId
 * @property string $email
 * @property User $user
 */
class Partner extends \yii\db\ActiveRecord
{
    const SUM = 1000;
    public $email;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user_partner}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['email','email','on'=>'card.activate'],
            ['email','exist','targetClass'=>'app\modules\cms\models\User','targetAttribute'=>'username','message'=>'Партнер с таким email не найден!','on'=>'card.activate'],
            [['userId', 'partnerId'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'userId' => Yii::t('app', 'Пользователь'),
            'partnerId' => Yii::t('app', 'Партнер'),
        ];
    }
    
    public function create($user)
    {
        if(empty($this->email))
            return false;
        
        
        $partner = User::findOne(['username'=>$this->email]);
        $this->userId = $user->id;
        $this->partnerId = $partner->id;
        $this->save();

        $id = md5($user->id.''.$partner->id);
        $historyModel = new BalanceHistory;
        $historyModel->add($partner->id, self::SUM, $user->dateCreate,$id);
        $partner->profile->updateBalance();
    }
    
    public function getUser()
    {
        return $this->hasOne(User::className(),['id'=>'userId']);
    }
    
    public function invitedList(){
        $query = self::find();
        $query->with(['user']);
        
        $dataProvider = new \yii\data\ActiveDataProvider([
           'query'=>$query, 
        ]);
       
        
        $query->where(['partnerId'=>Yii::$app->user->id]);
        
        return $dataProvider;
    }
    
    
}
