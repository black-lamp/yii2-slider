<?php
use yii\db\Migration;

/**
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 */
class m161113_114735_add_columns_for_behavior_to_slider_table extends Migration
{
    public function up()
    {
        $this->addColumn('slider', 'entity_id', $this->integer());
        $this->addColumn('slider', 'entity_name', $this->string(500));
    }

    public function down()
    {
        $this->dropColumn('slider', 'entity_name');
        $this->dropColumn('slider', 'entity_id');
    }
}
