<?php

namespace app\modules\cms\models;

use Yii;

/**
 * This is the model class for table "{{%settings}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $value
 * @property string $module
 */
class Settings extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%settings}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 128],
            [['value'], 'string', 'max' => 300],
            [['module'], 'string', 'max' => 32]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Параметр'),
            'value' => Yii::t('app', 'Значение'),
            'module' => Yii::t('app', 'Модуль'),
        ];
    }

    static $settings = [];
    static $instance = [];
    public static function get($module,$name)
    {
        if(!empty(self::$settings[$module]))
        {
            if(isset(self::$settings[$module][$name]))
                return self::$settings[$module][$name];
            return;
        }elseif(isset(self::$instance[$module])){
            $model = new Settings();
            $model->module = $module;
            $model->name = $name;
            $module->save();
            return null;
        }
        $row =  self::find()->where(['module'=>$module])->all();
        foreach($row as $item)
        {
            self::$settings[$item->module][$item->name] = $item->value;
        }
        self::$instance[$module] = true;
        return self::get($module,$name);
    }

    public static function set($module, $name,$value)
    {
        $row = self::find()->where(['module' => $module, 'name' => $name])->one();
        if($row)
            $row->delete();
        $model = new Settings();
        $model->module = $module;
        $model->name = $name;
        $model->value = $value;
        return $model->save();
    }

    public function updateSettings()
    {
        $data = \Yii::$app->request->post('Settings');
        foreach($data as $id=>$row)
        {
            $model = self::findOne($id);
            $model->value = $row['value'];
            $model->save(false,['value']);
        }
        return true;
    }
}
