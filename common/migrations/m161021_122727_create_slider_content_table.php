<?php
use yii\db\Migration;

/**
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 */
class m161021_122727_create_slider_content_table extends Migration
{
    public function up()
    {
        $this->createTable('slider_content', [
            'id' => $this->primaryKey(),
            'slider_id' => $this->integer()->notNull(),
            'content' => $this->text()->notNull(),
            'params' => $this->string(),
            'position' => $this->integer()->notNull(),
            'is_image' => $this->boolean()->notNull()->defaultValue(true)
        ]);

        $this->createIndex('slider_content-slider_id-IDX', 'slider_content', 'slider_id');

        $this->addForeignKey('slider_content-slider-FK', 'slider_content', 'slider_id',
            'slider', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropIndex('slider_content-slider_id-IDX', 'slider_content');

        $this->dropForeignKey('slider_content-slider-FK', 'slider_content');

        $this->dropTable('slider_content');
    }
}
