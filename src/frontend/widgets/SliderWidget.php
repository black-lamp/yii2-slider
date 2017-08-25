<?php
/**
 * @link https://github.com/black-lamp/yii2-slider
 * @copyright Copyright (c) Vladimir Kuprienko
 * @license BSD 3-Clause License
 */

namespace bl\slider\frontend\widgets;

use yii\base\Widget;

use bl\slider\common\entities\Slider;

/**
 * Widget for rendering the slider
 *
 * @property string $sliderKey
 * @property array $slickSliderOptions
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 */
class SliderWidget extends Widget
{
    /**
     * @var string slider key
     */
    public $sliderKey;
    /**
     * @var string pattern for image
     */
    public $imagePattern =
    '<div style="background: url({url}) {params} no-repeat; background-size: cover; height: 400px;"></div>';
    /**
     * @var array configuration options for Slick slider
     * @see http://kenwheeler.github.io/slick/ for more information
     */
    public $slickSliderOptions = [
        'slidesToShow' => 3,
        'slidesToScroll' => 1,
        'autoplay' => true,
        'autoplaySpeed' =>  2000
    ];

    /**
     * @var Slider
     */
    protected $_slider;


    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->_slider = Slider::find()
            ->key($this->sliderKey)
            ->withSlides('position')
            ->one();
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        return $this->render('slider', [
            'slider' => $this->_slider,

            'slickSliderOptions' => json_encode($this->slickSliderOptions),
            'imagePattern' => $this->imagePattern
        ]);
    }

    /**
     * Method for getting image by pattern
     *
     * @param string $url
     * @param string $params
     * @param string $imagePattern
     * @return string
     */
    public static function getImageByPattern($url, $params, $imagePattern)
    {
        return strtr($imagePattern, [
            '{url}' => $url,
            '{params}' => $params
        ]);
    }
}