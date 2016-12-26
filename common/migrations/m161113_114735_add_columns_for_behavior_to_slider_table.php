<?php
/**
 * @link https://github.com/black-lamp/yii2-slider
 * @copyright Copyright (c) Vladimir Kuprienko
 * @license BSD 3-Clause License
 */

use yii\db\Migration;

/**
 * Handles adding entity_id and entity_name to table `slider_content`.
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 */
class m161113_114735_add_columns_for_behavior_to_slider_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('slider', 'entity_id', $this->integer());
        $this->addColumn('slider', 'entity_name', $this->string(500));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('slider', 'entity_name');
        $this->dropColumn('slider', 'entity_id');
    }
}
