<?php
namespace bl\slider\backend\models;

use yii;
use yii\base\Model;
use yii\web\UploadedFile;

use bl\slider\common\helpers\File;
use bl\slider\common\helpers\Directory;

/**
 * Model class for uploading image
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 *
 * @property UploadedFile $imageFile
 */
class UploadImage extends Model
{
    /**
     * @var UploadedFile
     */
    public $imageFile;

    public function rules()
    {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, jpeg, gif']
        ];
    }

    /**
     * Method for generating unique image name
     *
     * @param string $path
     * @param string $filePrefix
     * @return string
     */
    protected function getImageName($path, $filePrefix)
    {
        $fileName = File::getCrc32RandomName(
            $this->imageFile->baseName, $this->imageFile->extension, $filePrefix
        );

        if(Directory::isExists($path . '/' . $fileName)) {
            $this->getImageName($path, $filePrefix);
        }

        return $fileName;
    }

    /**
     * Method for uploading the image to the server
     *
     * @param string $imagesRoot path to image directory
     * @param $filePrefix prefix for image files
     * @return bool|string returns path to image if the file is saved successfully
     */
    public function upload($imagesRoot, $filePrefix)
    {
        if($this->validate()) {
            $imagesRoot = Yii::getAlias($imagesRoot);

            Directory::create($imagesRoot, true);

            $fileName = $this->getImageName($imagesRoot, $filePrefix);
            $path = File::getPathToFile($imagesRoot, $fileName);

            if($this->imageFile->saveAs($path)) {
                return File::getUrlToFile($path, "web");
            }
        }

        return false;
    }
}