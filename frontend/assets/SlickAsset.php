<?php
namespace bl\slider\frontend\assets;

use yii\web\AssetBundle;

/**
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 */
class SlickAsset extends AssetBundle
{
    public $sourcePath = '@bower/slick-carousel/slick';

    public $css = [
        'slick.css',
        'slick-theme.css'
    ];

    public $js = [
        'slick.min.js'
    ];

    public $depends = [
        'yii\web\JqueryAsset'
    ];
}