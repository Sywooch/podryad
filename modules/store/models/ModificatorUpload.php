<?php
/**
 * Created by PhpStorm.
 * User: ivphpan
 * Date: 14.08.15
 * Time: 14:52
 */

namespace app\modules\store\models;


use yii\base\Model;
use yii\web\UploadedFile;

/**
 * Class ModificatorUpload
 * @package app\modules\store\models
 * @property UploadedFile $file
 */

class ModificatorUpload extends Model{

    public $file;
    public $categoryId;
    public $productId;

    public function rules()
    {
        return [
            [['productId','categoryId'],'required'],
          ['file','file','extensions'=>['csv']],
        ];
    }

    public function attributeLabels()
    {
        return [
          'categoryId'=>'Категория',
          'productId'=>'Товар',
          'file'=>'Файл импорта в формате CSV',
        ];
    }

    public function import()
    {
        $f = fopen($this->file->tempName,'rb');
        $result = true;
        $i = 0;

        while($row = fgetcsv($f,2048,';','"'))
        {
            array_map('trim',$row);
            list($category,$key,$value) = $row;

            if($i == 0 && empty($category)) {
                $result = false;
                $this->addError('file','Неверный формат файла');
                break;
            }

            $i++;

            if(!empty($category))
            {
                $modelCategory = ModificatorCategory::find()->where(['title'=>$category,'productId'=>$this->productId])->one();
                if(!$modelCategory)
                {
                    $modelCategory = new ModificatorCategory();
                }
                $modelCategory->title = $category;
                $modelCategory->productId = $this->productId;
                $modelCategory->categoryId = $this->categoryId;
                $modelCategory->memo = $key;
                $modelCategory->save();
                continue;
            }

            $modelItem = ModificatorItem::find()->where(['title'=>$key,'categoryId'=>$modelCategory->id])->one();
            if(!$modelItem)
            {
                $modelItem = new ModificatorItem();
            }
            $modelItem->categoryId = $modelCategory->id;
            $modelItem->title = $key;
            $modelItem->content = $value;
            $modelItem->save();
        }
        fclose($f);
        return $result;
    }

}