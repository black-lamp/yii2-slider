<?php
/**
 * @link https://github.com/black-lamp/yii2-slider
 * @copyright Copyright (c) Vladimir Kuprienko
 * @license BSD 3-Clause License
 */

namespace bl\slider\backend\models\forms;

use yii\base\Model;

use bl\slider\common\entities\SliderContent;

/**
 * Base model class for content forms
 *
 * @property integer $sliderId
 * @property string $content
 * @property string $params
 * @property integer $position
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 */
abstract class BaseContentForm extends Model
{
    /**
     * @var integer
     */
    public $sliderId;
    /**
     * @var string
     */
    public $content;
    /**
     * @var string
     */
    public $params;
    /**
     * @var integer
     */
    public $position;

    /**
     * @var SliderContent
     */
    protected $_content;


    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->_content = new SliderContent();
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sliderId'], 'integer'],
            [['sliderId'], 'required'],

            [['content'], 'string'],
            [['content'], 'required'],

            [['position'], 'integer'],
            [['position'], 'required'],

            [['params'], 'string', 'max' => 255]
        ];
    }

    /**
     * Method for saving content to database
     *
     * @return bool
     */
    public function save()
    {
        $this->_content->slider_id = $this->sliderId;
        $this->_content->position = $this->position;
        $this->_content->content = $this->content;
        $this->_content->params = $this->params;

        return $this->_content->insert(false);
    }
}
