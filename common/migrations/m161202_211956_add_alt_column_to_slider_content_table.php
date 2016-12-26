<?php
/**
 * @link https://github.com/black-lamp/yii2-slider
 * @copyright Copyright (c) Vladimir Kuprienko
 * @license BSD 3-Clause License
 */

use yii\db\Migration;

/**
 * Handles adding alt to table `slider_content`.
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 */
class m161202_211956_add_alt_column_to_slider_content_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('slider_content', 'alt', $this->string(255)->notNull()->defaultValue(''));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('slider_content', 'alt');
    }
}
