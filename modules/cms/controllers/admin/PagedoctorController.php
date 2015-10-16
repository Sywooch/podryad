<?php

namespace app\modules\cms\controllers\admin;

use app\modules\cms\models\Page;
use Yii;
use app\modules\cms\models\PageDoctor;
use app\modules\cms\models\PageDoctorSearch;
use app\modules\cms\controllers\admin\AdminController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PagedoctorController implements the CRUD actions for PageDoctor model.
 */
class PagedoctorController extends AdminController
{
    /**
     * Creates a new PageDoctor model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($pageId)
    {
        $model = new PageDoctor();
        $model->pageId = $pageId;
        $page = Page::findOne($pageId);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['/cms/admin/page/update','id'=>$model->pageId,'tab'=>'personal']);
        } else {
            return $this->render('create', [
                'model' => $model,
                'page' => $page,
            ]);
        }
    }

    /**
     * Updates an existing PageDoctor model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing PageDoctor model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id,$pageId)
    {
        $model = $this->findModel($id,$pageId);
        $pageId = $model->pageId;
        $model->delete();
        return $this->redirect(['/cms/admin/page/update', 'id' => $pageId,'tab'=>'personal']);
    }

    /**
     * Finds the PageDoctor model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PageDoctor the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id,$pageId)
    {
        if (($model = PageDoctor::findOne(['id'=>$id,'pageId'=>$pageId])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
