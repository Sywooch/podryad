<?php
/**
 * Created by PhpStorm.
 * User: ivphpan
 * Date: 02.10.15
 * Time: 15:22
 */

namespace app\modules\exchange\controllers;


use app\modules\cms\models\Image;
use app\modules\cms\models\User;
use app\modules\exchange\models\Tender;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\UploadedFile;

class TenderController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only'=>['create'],
                'rules' => [
                    ['allow' => true, 'roles' => [User::ROLE_CUSTOMER], 'actions' => ['create', 'my']],
                    ['allow' => true, 'roles' => ['?','@'], 'actions' => ['index', 'view']],
                ]
            ]
        ];
    }

    public function actionIndex()
    {
        $model = new \app\modules\exchange\models\Tender();
        $model->scenario = 'new';
        if ($model->load($_POST) && $model->validate()) {
            return $this->redirect(['create', 'id' => $model->id]);
        }

        $search = \app\modules\exchange\models\Tender::find()->joinWith(['user', 'specialization'])->open()->orderNew();

        if (\Yii::$app->request->isGet && !empty($_GET)) {
            $model->scenario = 'filter';
            $model->load($_GET);

            if ($model->specializationIds)
                $search->andWhere(['specializationId' => $model->specializationIds]);

            if($model->priceMin && $model->priceMax)
            {
                $search->andWhere(['>=', 'price', (int)$model->priceMin]);
                $search->andWhere(['<=', 'price', (int)$model->priceMax]);
            }
        }

        if (!empty(\Yii::$app->request->cookies['city'])) {
            $params['cityId'] = \Yii::$app->request->cookies['city'];
            $search->joinWith(['user.profile' => function ($query) use ($params){
                return $query->where(['iv_user_profile.cityId' => $params['cityId']]);
            }]);
        }

        $countQuery = clone $search;
        $pages = new Pagination(['totalCount' => $countQuery->count(),'pageSize'=>\Yii::$app->params['pageSize']]);

        $list = $search->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('index', ['model' => $model, 'list' => $list,'pages'=>$pages]);
    }

    public function actionCreate()
    {
        $model = new Tender();
        if(\Yii::$app->request->isPost)
        {
            $model->load($_POST);
        }else
        {
            $model->phone = \Yii::$app->user->identity->profile->phone;
        }
        $model->scenario = 'create';
        $model->active = Tender::IS_OPEN;
        if ($model->load($_POST) && \Yii::$app->request->referrer == Url::to(['create'],true)) {
            $model->file = UploadedFile::getInstance($model, 'file');
            if ($model->validate()) {
                $model->save();

                if($model->file)
                {
                    $image = new Image();
                    $image->model = $model::className();
                    $image->primaryKey = $model->id;
                    $image->file = $model->file;
                    $image->create();
                }

                $this->redirect(['view', 'id' => $model->id]);
            }
        }
        return $this->render('create', ['model' => $model]);
    }

    public function actionView($id)
    {
        $model = $this->loadModel($id);
        return $this->render('view', ['model' => $model]);
    }

    /**
     * @param $id
     * @return \app\modules\exchange\models\Tender
     * @throws HttpException
     */
    protected function loadModel($id)
    {
        $model = \app\modules\exchange\models\Tender::findOne($id);
        if (!$model)
            throw new HttpException(404);
        return $model;
    }

    public function actionMy($contractorId)
    {
        if(\Yii::$app->request->isAjax)
        {
            $modelList = Tender::find()->where(['userId' => \Yii::$app->user->id])->open()->all();
            return $this->renderPartial('my',['modelList'=>$modelList,'contractorId'=>$contractorId]);
        }
        throw new HttpException('403');
    }

}