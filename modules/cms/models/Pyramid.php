<?php

namespace app\modules\cms\models;

use app\modules\cms\components\CategoryBehavior;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%pyramid}}".
 *
 * @property integer $id
 * @property string $title
 * @property \app\modules\cms\models\Pyramid $title
 * @property integer $parentId
 * @property integer $tour
 * @property integer $lvl
 * @property integer $position
 */
class Pyramid extends \yii\db\ActiveRecord
{
    public $level;
    const STEPS = 2;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%pyramid}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parentId'], 'integer'],
            [['parentId'],'default','value'=>0],
            [['title'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Название'),
            'parentTitle' => Yii::t('app', 'Родитель'),
            'parentId' => Yii::t('app', 'Родитель'),
        ];
    }

    public function behaviors()
    {
        return [
            'category'=>[
                'class'=>CategoryBehavior::className(),
            ]
        ];
    }

    public function getParent()
    {
        return $this->hasOne(Pyramid::className(),['id'=>'parentId']);
    }

    public function getParentTitle()
    {
        $parent = $this->parent;
        return $parent ? $parent->title : 'нет родителя';
    }

    public function pyramid()
    {
        $childrens = $this->childrens();

        $steps = 2;
        $lvl = 1;
        $maxLevel = 3;
        $currentSteps = pow($steps,$lvl);

        $data = [];
        $position = 1;

        for($i=1;$i<=$currentSteps;$i++)
        {
            $k = $position-1;

            if(!empty($childrens[$k]))
            {
                $item = $childrens[$k];
            }else{
                $model = new Pyramid();
                $model->title = 'Место '.$position;
                $item = $model;
            }

            $data[$lvl][$i]=$item;

            if($i == $currentSteps)
            {
                $i=0;
                $lvl++;
                $currentSteps = pow($steps,$lvl);
            }

            $position++;

            if($lvl-1==$maxLevel)
                break;
        }
        return $data;
    }
}
