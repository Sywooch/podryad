<?php

use yii\db\Migration;

/**
 * Handles the creation for table `{{%custom_seo}}`.
 */
class m160817_051840_create_custom_seo extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%custom_seo}}', [
            'id' => $this->primaryKey(),
            'specializationId'=>$this->integer()->comment('Специализация'),
            'cityId'=>$this->integer()->comment('Город'),
            'h1'=>$this->string(),
            'title'=>$this->string(),
            'metaKeywords'=>$this->string(),
            'metaDescription'=>$this->string(300),
        ]);

        $this->createIndex('idx-specializationId','{{%custom_seo}}','specializationId');
        $this->createIndex('idx-cityId','{{%custom_seo}}','cityId');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%custom_seo}}');
    }
}
