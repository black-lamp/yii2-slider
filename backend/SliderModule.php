<?php
namespace bl\slider\backend;

use yii;
use yii\base\Module;

/**
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 *
 * @property string $imagesDir
 * @property string $imagePrefix
 */
class SliderModule extends Module
{
    public $controllerNamespace = 'bl\slider\backend\controllers';
    public $defaultRoute = 'slider';

    /**
     * @var string Path to image directory
     */
    public $imagesDir = 'img/slider';
    /**
     * @var string prefix for image files
     */
    public $imagePrefix = 'slider';

    public static function t($category, $message, $params = [], $language = null)
    {
        return Yii::t('slider' . $category, $message, $params, $language);
    }
}