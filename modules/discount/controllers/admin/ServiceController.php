<?php
/**
 * Created by PhpStorm.
 * User: ivphpan
 * Date: 19.05.15
 * Time: 15:47
 */

namespace app\modules\discount\controllers\admin;


use app\modules\cms\controllers\admin\AdminController;
use app\modules\discount\models\Partner;
use app\modules\discount\models\Service;

class ServiceController extends AdminController{

    public function actionCreate($parentId)
    {
        $partner = Partner::findOne($parentId);
        $model = new Service();
        $model->parentId = $parentId;
        $model->categoryId = $partner->parentId;
        if($model->load($_POST) && $model->save())
        {
            return $this->redirect(['/discount/admin/partner/update','id'=>$parentId,'section'=>'two']);
        }
        else
        {
           return $this->render('create',['model'=>$model]);
        }
    }

    public function actionUpdate($id)
    {
        $model = Service::findOne($id);
        if($model->load($_POST) && $model->save())
        {
            return $this->redirect(['/discount/admin/partner/update','id'=>$model->parentId,'section'=>'two']);
        }
        else
        {
            return $this->render('update',['model'=>$model]);
        }
    }

    public function actionDelete($id)
    {
        $model = Service::findOne($id);
        $model->delete();
        return $this->redirect(['discount/admin/update','id'=>$model->parentId,'section'=>'two']);
    }

}