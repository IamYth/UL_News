<?php

use yii\db\Migration;

/**
 * Handles the creation of table `source`.
 */
class m170112_115631_create_source_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('source', [
            'id' => $this->primaryKey(),
            'link' => $this->string(),
            'logo' => $this->string(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('source');
    }
}
