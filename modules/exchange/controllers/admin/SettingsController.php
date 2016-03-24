<?php
namespace app\modules\exchange\controllers\admin;


use app\modules\cms\controllers\admin\AdminController;
use app\modules\exchange\models\forms\TenderSettings;

class SettingsController extends AdminController
{

    public function actionIndex()
    {
        $model = new TenderSettings();
        if(\Yii::$app->request->isPost && $model->load($_POST) && $model->save())
        {
            \Yii::$app->session->setFlash('success','Настройки успешно сохраненны');
            return $this->refresh();
        }
        return $this->render('index',['model'=>$model]);
    }

}