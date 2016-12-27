<?php
/**
 * @link https://github.com/black-lamp/yii2-slider
 * @copyright Copyright (c) Vladimir Kuprienko
 * @license BSD 3-Clause License
 */

namespace bl\slider\backend;

use Yii;

/**
 * Backend module definition class
 *
 * @property string $imagesRoot
 * @property string $imagePrefix
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'bl\slider\backend\controllers';
    /**
     * @inheritdoc
     */
    public $defaultRoute = 'slider';
    /**
     * @var string Path to image directory
     */
    public $imagesRoot = '@frontend/web/img/slider';
    /**
     * @var string prefix for image files
     */
    public $imagePrefix = 'slider';


    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->registerDependencies();
    }

    /**
     * Register dependencies to DI container
     */
    public function registerDependencies()
    {
        Yii::$container->set('bl\slider\backend\models\UploadImage', [], [
            $this->imagesRoot,
            $this->imagePrefix
        ]);
        Yii::$container->set('UploadImageModel', 'bl\slider\backend\models\UploadImage');

        Yii::$container->set('bl\slider\backend\models\forms\AddImage', [], [
            'uploadedImage' => Yii::$container->get('UploadImageModel')
        ]);
        Yii::$container->set('AddImageModel', 'bl\slider\backend\models\forms\AddImage');
    }

    /**
     * Wrapper for default method `Yii::t()`
     *
     * @param string $category
     * @param string $message
     * @param array $params
     * @param null $language
     * @return string returns result of `Yii::t()` method
     */
    public static function t($category, $message, $params = [], $language = null)
    {
        return Yii::t('slider.' . $category, $message, $params, $language);
    }
}