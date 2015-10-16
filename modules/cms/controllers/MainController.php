<?php
/**
 * Created by PhpStorm.
 * User: ivphpan
 * Date: 22.09.15
 * Time: 12:10
 */

namespace app\modules\cms\controllers;


use yii\filters\AccessControl;
use yii\web\Controller;

class MainController extends Controller{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => [],
                        'roles' => ['client'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['pending'],
                        'roles' => ['@'],
                    ]
                ],
            ],
        ];
    }

}