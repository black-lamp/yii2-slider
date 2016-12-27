<?php
/**
 * @link https://github.com/black-lamp/yii2-slider
 * @copyright Copyright (c) Vladimir Kuprienko
 * @license BSD 3-Clause License
 */

namespace bl\slider\backend\models\forms;

/**
 * Model for adding HTML content to slider
 *
 * @property integer $sliderId
 * @property string $content
 * @property string $params
 * @property integer $position
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 */
class AddHtml extends BaseContentForm
{
    /**
     * @inheritdoc
     */
    public function save()
    {
        $this->_content->is_image = false;

        if(!$this->validate()) {
            return false;
        }

        return parent::save();
    }
}