<?php

/**
 * Created by PhpStorm.
 * User: ivphpan
 * Date: 18.05.15
 * Time: 16:11
 */

namespace app\modules\cms\controllers\admin;

use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;

class AdminController extends Controller {

    public $layout = '@app/modules/cms/views/layouts/main';
    protected $_rules = [
        [
            'allow' => true,
            'roles' => ['manager'],
        ],
        ['allow' => false, 'roles' => ['?']]
    ];

    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => $this->_rules 
            ]
        ];
    }

    public function __construct($id, $module, $config = array()) {
        $this->accessInit();
        parent::__construct($id, $module, $config);
    }

    public function accessInit() {
        $rules = $this->rules;
    }

}
