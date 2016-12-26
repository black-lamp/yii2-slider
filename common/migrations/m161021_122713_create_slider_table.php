<?php
/**
 * @link https://github.com/black-lamp/yii2-slider
 * @copyright Copyright (c) Vladimir Kuprienko
 * @license BSD 3-Clause License
 */

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
