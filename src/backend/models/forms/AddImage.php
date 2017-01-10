<?php
/**
 * @link https://github.com/black-lamp/yii2-slider
 * @copyright Copyright (c) Vladimir Kuprienko
 * @license BSD 3-Clause License
 */

namespace bl\slider\backend\models\forms;

use bl\slider\common\helpers\StringHelper;
use yii\web\UploadedFile;

use bl\slider\backend\models\UploadImage;

/**
 * Model for adding image to slider
 *
 * @property string $alt
 *
 * @property integer $sliderId
 * @property string $content
 * @property string $params
 * @property integer $position
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 */
class AddImage extends BaseContentForm
{
    /**
     * @var string
     */
    public $alt;

    /**
     * @var UploadImage
     */
    private $_uploadedImage;
    /**
     * @var string
     */
    private $_urlSeparator;


    /**
     * @inheritdoc
     * @param UploadImage $uploadedImage
     */
    public function __construct($urlSeparator, UploadImage $uploadedImage, array $config = [])
    {
        $this->_urlSeparator = $urlSeparator;
        $this->_uploadedImage = $uploadedImage;

        parent::__construct($config);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_merge(parent::rules(), [
            [['alt'], 'string', 'max' => 255],
        ]);
    }

    /**
     * @inheritdoc
     */
    public function save()
    {
        $this->_content->alt = $this->alt;

        if($this->_uploadedImage->imageFile = UploadedFile::getInstance($this->_uploadedImage, 'imageFile')) {
            $this->content = StringHelper::substrBySeparator($this->_uploadedImage->upload(), $this->_urlSeparator);
        }

        if (!$this->validate()) {
            return false;
        }

        return parent::save();
    }
}