<?php
namespace bl\slider\backend\models;

use yii;
use yii\base\Model;
use yii\web\UploadedFile;

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
     * @param string $imagesDir path to image directory
     * @param $filePrefix prefix for image files
     * @return bool|string returns path to image if the file is saved successfully
     */
    public function upload($imagesDir, $filePrefix)
    {
        if($this->validate()) {
            $path = sprintf("%s/%s-%s.%s",
                $imagesDir,
                $filePrefix,
                Yii::$app->security->generateRandomString(),
                $this->imageFile->extension
            );

            if($this->imageFile->saveAs($path)) {
                return $path;
            }
        }

        return false;
    }
}