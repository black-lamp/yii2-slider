<?php
use yii\db\Migration;

/**
 * Handles the creation of table `slider`
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 */
class m161021_122713_create_slider_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('slider', [
            'id' => $this->primaryKey(),
            'key' => $this->string(255)->notNull()->unique()
        ]);

        $this->createIndex('slider-key-IDX', 'slider', 'key');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropIndex('slider-key-IDX', 'slider');

        $this->dropTable('slider');
    }
}
