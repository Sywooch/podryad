<?php

namespace app\modules\exchange\controllers\admin;

use app\modules\cms\controllers\admin\AdminController;
use app\modules\cms\models\Image;
use Yii;
use app\modules\exchange\models\Projecthouse;
use app\modules\exchange\models\ProjecthouseSearch;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

/**
 * ProjecthouseController implements the CRUD actions for Projecthouse model.
 */
class ProjecthouseController extends AdminController
{
    /**
     * Lists all Projecthouse models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProjecthouseSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Projecthouse model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Projecthouse model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Projecthouse();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $model->file = UploadedFile::getInstance($model,'file');

            if($model->file)
            {
                $image = new Image();
                $image->model = $model::className();
                $image->primaryKey = $model->id;
                $image->file = $model->file;
                $image->create();
            }

            return $this->redirect(['index', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Projecthouse model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $model->file = UploadedFile::getInstance($model, 'file');

            if ($model->file) {

                if(($image = $model->image))
                {
                    $image->delete();
                }

                $image = new Image();
                $image->model = $model::className();
                $image->primaryKey = $model->id;
                $image->file = $model->file;
                $image->create();
            }

            return $this->redirect(['update', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Projecthouse model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Projecthouse model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Projecthouse the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Projecthouse::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
