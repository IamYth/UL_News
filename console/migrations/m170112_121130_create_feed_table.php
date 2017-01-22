<?php

use yii\db\Migration;

/**
 * Handles the creation of table `feed`.
 * Has foreign keys to the tables:
 *
 * - `source`
 */
class m170112_121130_create_feed_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('feed', [
            'id' => $this->primaryKey(),
            'source_id' => $this->integer()->notNull(),
            'name' => $this->string(255),
            'description' => $this->string(),
            'link' => $this->string(),
        ]);

        // creates index for column `source_id`
        $this->createIndex(
            'idx-feed-source_id',
            'feed',
            'source_id'
        );

        // add foreign key for table `source`
        $this->addForeignKey(
            'fk-feed-source_id',
            'feed',
            'source_id',
            'source',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `source`
        $this->dropForeignKey(
            'fk-feed-source_id',
            'feed'
        );

        // drops index for column `source_id`
        $this->dropIndex(
            'idx-feed-source_id',
            'feed'
        );

        $this->dropTable('feed');
    }
}
