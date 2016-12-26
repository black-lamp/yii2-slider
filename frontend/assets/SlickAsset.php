<?php
/**
 * @link https://github.com/black-lamp/yii2-slider
 * @copyright Copyright (c) Vladimir Kuprienko
 * @license BSD 3-Clause License
 */

namespace bl\slider\frontend\assets;

use yii\web\AssetBundle;

/**
 * Asset for slick
 * @see https://github.com/kenwheeler/slick/
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 */
class SlickAsset extends AssetBundle
{
    /**
     * @inheritdoc
     */
    public $sourcePath = '@bower/slick-carousel/slick';
    /**
     * @inheritdoc
     */
    public $css = [
        'slick.css',
        'slick-theme.css'
    ];
    /**
     * @inheritdoc
     */
    public $js = [
        'slick.min.js'
    ];
    /**
     * @inheritdoc
     */
    public $depends = [
        'yii\web\JqueryAsset'
    ];
}