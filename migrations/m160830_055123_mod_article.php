<?php

use yii\db\Migration;

class m160830_055123_mod_article extends Migration
{
    public function up()
    {
        $this->addColumn('{{%article}}','datePublish',$this->dateTime()->comment('Дата публикации'));
        $this->createIndex('idx-datePublish','{{%article}}','datePublish');
        \app\modules\cms\models\Article::updateAll(['datePublish'=>new \yii\db\Expression('now()')]);
    }

    public function down()
    {
        $this->dropColumn('{{%article}}', 'datePublish');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
