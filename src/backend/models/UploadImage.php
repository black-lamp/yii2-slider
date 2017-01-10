<?php
/**
 * @link https://github.com/black-lamp/yii2-slider
 * @copyright Copyright (c) Vladimir Kuprienko
 * @license BSD 3-Clause License
 */

namespace bl\slider\backend\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

use bl\slider\common\helpers\File;
use bl\slider\common\helpers\Directory;

/**
 * Model class for uploading image
 *
 * @property UploadedFile $imageFile
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 */
class UploadImage extends Model
{
    /**
     * @var UploadedFile
     */
    public $imageFile;

    /**
     * @var string
     */
    protected $_imagesRoot;
    /**
     * @var string
     */
    protected $_imagePrefix;


    /**
     * @param string $imagesRoot
     * @param string $imagePrefix
     * @inheritdoc
     */
    public function __construct($imagesRoot, $imagePrefix, array $config = [])
    {
        $this->_imagesRoot = Yii::getAlias($imagesRoot);
        $this->_imagePrefix = $imagePrefix;

        parent::__construct($config);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, jpeg, gif']
        ];
    }

    /**
     * Method for generating unique image name
     *
     * @return string
     */
    protected function getImageName()
    {
        $fileName = File::getCrc32RandomName(
            $this->imageFile->baseName, $this->imageFile->extension, $this->_imagePrefix
        );

        if(Directory::isExists($this->_imagesRoot . '/' . $fileName)) {
            $this->getImageName();
        }

        return $fileName;
    }

    /**
     * Method for uploading the image to the server
     *
     * @return bool|string returns path to image if the file is saved successfully
     */
    public function upload()
    {
        if($this->validate()) {
            Directory::create($this->_imagesRoot, true);

            $fileName = $this->getImageName();
            $path = File::getPathToFile($this->_imagesRoot, $fileName);

            if($this->imageFile->saveAs($path)) {
                return $path;
            }
        }

        return false;
    }
}
