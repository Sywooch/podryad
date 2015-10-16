<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\modules\discount\controllers;
use \Yii;
/**
 * Description of UserController
 *
 * @author ivphpan
 */
class UserController extends \yii\web\Controller{
    //put your code here
    public $layout = '@app/modules/discount/views/layouts/main';
    public function behaviors()
    {
        return [
          'access'=>[
              'class'=>  \yii\filters\AccessControl::className(),
              'rules'=>[
                  [
                      'allow'=>true,
                      'actions'=>['client-history','partner'],
                      'roles'=>['client'],
                  ],
                  [
                      'allow'=>true,
                      'actions'=>['partner-history'],
                      'roles'=>['partner'],
                  ],
              ]
          ]  
        ];
    }
    
    public function actionClientHistory()
    {
        $historyModel = new \app\modules\discount\models\History();
        $historyModel->scenario = 'search';
        $historyModel->load($_POST);
        $userId = Yii::$app->user->id;
        $items = $historyModel->findByUserId($userId);
        return $this->render('clientHistory',[
            'items'=>$items,
            'historyModel'=>$historyModel,
        ]);
    }
    
    public function actionPartnerHistory()
    {
        $historyModel = new \app\modules\discount\models\History();
        $historyModel->scenario = 'search';
        $historyModel->load($_POST);
        $partnerId = \app\modules\discount\models\Partner::getIdByUserId();
        $items = $historyModel->findByPartnerId($partnerId);
        return $this->render('partnerHistory',[
            'items'=>$items,
            'historyModel'=>$historyModel,
        ]);
    }
    
    public function actionPartner()
    {
        $model = new \app\modules\cms\models\Partner;
        $items = $model->invitedList();
        $historyList = \app\modules\cms\models\BalanceHistory::getByUserId();
        return $this->render('partner',['items'=>$items,'historyList'=>$historyList]);
    }
}
