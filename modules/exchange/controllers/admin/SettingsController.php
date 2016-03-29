<?php
namespace app\modules\exchange\controllers\admin;


use app\modules\cms\controllers\admin\AdminController;
use app\modules\cms\models\Settings;
use app\modules\exchange\models\forms\TenderSettings;
use yii\data\ActiveDataProvider;

class SettingsController extends AdminController
{

    public function actionIndex()
    {
        $provider = new ActiveDataProvider([
            'query' => Settings::find()->where(['isSystem'=>0])->orderBy(['module'=>SORT_ASC]),
            'pagination' => [
                'pageSize' => 1000,
            ],
        ]);
        $model = new Settings();
        if(\Yii::$app->request->isPost && $model->updateSettings())
        {
            \Yii::$app->session->setFlash('success','Настройки успешно сохраненны');
            return $this->refresh();
        }
        return $this->render('index',['model'=>$model,'provider'=>$provider]);
    }

}