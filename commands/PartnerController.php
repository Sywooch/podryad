<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\commands;

/**
 * Description of Partner
 *
 * @author ivphpan
 */
class PartnerController extends \yii\console\Controller {

    //put your code here

    public function actionCalculate() {
        /* @var $userList \app\modules\cms\models\User[] */
        /* @var $partnerList \app\modules\cms\models\Partner[] */
        /* @var $historyModel \app\modules\cms\models\BalanceHistory */
        /* @var $historyList \app\modules\cms\models\BalanceHistory[] */
        
        //получить всех пользователей
        $sum = 1000.00; //сумма за каждое зачисление
        $userList = \app\modules\cms\models\User::find()->all();
        $historyModel = new \app\modules\cms\models\BalanceHistory;
        foreach ($userList as $user) {
            $userId = $user->id;
//            echo $user->username."\r\n";
            //получить всех пользователей с партнерки
            $partnerList = \app\modules\cms\models\Partner::find()->where(['partnerId' => $userId])->all();
            //получить историю баланса по юзеру
            $historyList = \app\modules\cms\models\BalanceHistory::find()->partner()->all();
            $historyIdList = $historyModel->idList($historyList);
            
            if (sizeof($partnerList) > sizeof($historyList)) {
                foreach($partnerList as $partner)
                {
                    $id = md5($partner->userId.$partner->partnerId);
                    if(!in_array($id, $historyIdList))
                    {
//                        echo "\t".$id."\r\n";
                        $historyModel->add($userId, $sum, $partner->user->dateCreate,$id);
                    }
                }
            }
            
            $balance = $historyModel->getBalanceById($user->id);
            if(!$user->profile)
                continue;
            
            $user->profile->updateBalance($balance);
        }
    }

}
