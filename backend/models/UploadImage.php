<?php
namespace bl\slider\backend\models;

use yii;
use yii\base\Model;
use yii\web\UploadedFile;

use bl\slider\common\helpers\File;
use bl\slider\common\helpers\base\Directory;

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

            $fileName = File::getCrc32RandomName(
                $this->imageFile->baseName, $this->imageFile->extension, $filePrefix
            );
            $path = File::getPathToFile($imagesRoot, $fileName);

            if($this->imageFile->saveAs($path)) {
                return $fileName;
            }
        }

        return false;
    }
}