<?php

namespace app\modules\discount\controllers\admin;

use dosamigos\qrcode\QrCode;
use Yii;
use app\modules\discount\models\Card;
use app\modules\discount\models\CardSearch;
use app\modules\cms\controllers\admin\AdminController;
use yii\web\NotFoundHttpException;
use yii\web\Request;

/**
 * CardController implements the CRUD actions for Card model.
 */
class CardController extends AdminController
{
    /**
     * Lists all Card models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = new Card();
        $searchModel = new CardSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'model'=>$model,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionRelation()
    {
        $model = new Card();
        $model->scenario = 'relation';
        if($model->load(Yii::$app->request->post()))
        {
            $model->relationFile = \yii\web\UploadedFile::getInstance($model, 'relationFile');
            if($model->relationFile)
            {
                if(is_file($model->relationFile->tempName))
                {
                    $f = fopen($model->relationFile->tempName,'r');
                    $i = 0;
                    while($row = fgetcsv($f,2048,';'))
                    {
                        if($i++==0)
                        {
                            continue;
                        }
                        list($date,$num,$shrtih,$code,$codeMagnit) = $row;
                        $code = substr($code,  strripos($code, '/')+1);
                        $card = $model->findOne(['cvcode'=>$code]);
                        
                        if(!$card){
                            continue;
                        }
                        
                        if($num == 'активированы')
                        {
                            $card->delete();
                            continue;
                        }
                        
                        $card->insertNumber($num);
                    }
                    fclose($f);
                }
            }
            $this->redirect(['index']);
        }
    }

    /**
     * Creates a new Card model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Card();
        $quantity = Yii::$app->request->post('quantity');
        $type = Yii::$app->request->post('type');
        $maxResult = $model->getMaxId();
        for($i=1;$i<=$quantity;$i++)
        {
            $id = $maxResult->id + $i;

            $model->isNewRecord = true;
            $model->cvcode = $model->generateCard($id);
            $model->status = Card::STATUS_NEW;
            $model->type = $type;
            $model->save();
            $model->id = Yii::$app->db->lastInsertID + 1;
        }
        $this->redirect(['index']);
    }

    /**
     * Deletes an existing Card model.
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
     * Finds the Card model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Card the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Card::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionView($id)
    {
        $model = $this->findModel($id);
        return $this->render('view',['model'=>$model]);
    }

    public function actionPrint()
    {
        set_time_limit(0);
        $cardList = Card::find()->newCard()->all();
        $qrCode = new QrCode();
        $zip = new \ZipArchive();
        $zipFile = Card::CARD_DIR.'/card-files-'.date('dmYHis').'.zip';
        if($zip->open($zipFile,\ZipArchive::CREATE))
        {
            foreach($cardList as $card)
            {
                $filename = Card::CARD_DIR.'/'.$card->cvcode.'.png';
                $qrCode->png($card->fullurl,$filename);
                $card->toPrint();
                $baseName = basename($filename);
                $zip->addFile($filename,$baseName);
            }
            $zip->close();
        }
        Yii::$app->response->sendFile($zipFile,basename($zipFile));
    }
}
