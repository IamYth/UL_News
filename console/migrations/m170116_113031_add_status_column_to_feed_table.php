<?php

use yii\db\Migration;

/**
 * Handles adding status to table `feed`.
 */
class m170116_113031_add_status_column_to_feed_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('feed', 'status', $this->string());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('feed', 'status');
    }
}
