<?php

use yii\db\Migration;

/**
 * Handles the creation for table `projecthouse`.
 */
class m160519_042420_create_projectHouse extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%projecthouse}}', [
            'id' => $this->primaryKey(),
            'title'=>$this->string()->notNull()->comment('Название'),
            'alias'=>$this->string()->comment('Алиас'),
            'description'=>$this->text()->notNull()->comment('Описание'),
            'yandexDisk'=>$this->string()->comment('Ссылка на Яндекс-диск'),
            'googleDisk'=>$this->string()->comment('Ссылка на Google-диск'),
            'skyDrive'=>$this->string()->comment('Ссылка на skyDrive'),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%projecthouse}}');
    }
}
