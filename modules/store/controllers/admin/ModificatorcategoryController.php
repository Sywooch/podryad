<?php

namespace app\modules\store\controllers\admin;

use app\modules\store\models\ModificatorUpload;
use Yii;
use app\modules\store\models\ModificatorCategory;
use app\modules\store\models\ModificatorCategorySearch;
use app\modules\cms\controllers\admin\AdminController;
use yii\helpers\Html;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\web\UploadedFile;
use yii\widgets\ActiveForm;

/**
 * ModificatorcategoryController implements the CRUD actions for ModificatorCategory model.
 */
class ModificatorcategoryController extends AdminController
{
    public function actionImport()
    {
        $model = new ModificatorUpload();
        if($model->load($_POST))
        {
            $model->file = UploadedFile::getInstance($model,'file');

            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }

            if($model->import())
            {
                return $this->redirect(['/store/admin/product/update','id'=>$model->productId,'tab'=>'modificator']);
            }
        }
        echo Html::errorSummary($model);
    }

    public function actionUpdate($id)
    {
        $model =  $this->findModel($id);
        if($model->load($_POST) && $model->save())
        {
            return $this->redirect(['/store/admin/product/update','id'=>$model->productId,'tab'=>'modificator']);
        }
        return $this->render('update',['model'=>$model]);
    }

    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->delete();
        return $this->redirect(['/store/admin/product/update','id'=>$model->productId,'tab'=>'modificator']);
    }

    /**
     * Finds the ModificatorCategory model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ModificatorCategory the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ModificatorCategory::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
