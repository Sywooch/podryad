<?php

namespace app\modules\cms\controllers\admin;

use app\modules\cms\models\Profile;
use app\modules\discount\models\Request;
use Yii;
use app\modules\cms\models\User;
use app\modules\cms\models\UserSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends AdminController
{
    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
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
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();
        $profile = new Profile();

        $requestId = Yii::$app->request->get('requestId');
        if($requestId){
            $request = Request::findOne($requestId);
            $request->fillData($profile);
            $request->fillData($model);
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $profile->load($_POST);
            $profile->userId = $model->id;
            $profile->save();

            if($requestId)
            {
                $request->status = Request::STATUS_DONE;
                $request->userId = $model->id;
                $request->dateActivate = date('Y-m-d H:i:s');
                $request->save(false,['status','userId']);
            }

            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
                'profile' => $profile,
            ]);
        }
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $profile = $model->profile;
        
        if ($model->load(Yii::$app->request->post()) && $model->save() && $model->profile->load($_POST) && $model->profile->save()) {
            return $this->redirect(['index']);
        } else {
            $model->password = '';
            return $this->render('update', [
                'model' => $model,
                'profile'=>$profile,
            ]);
        }
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
    
    public function actionCrib($id)
    {
        $model = $this->findModel($id);
        $model->scenario = 'user.crib';
        if($model->load($_POST) && $model->validate())
        {
            $model->crib();
            $this->redirect(['index']);
        }
        return $this->render('crib',['model'=>$model]);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
