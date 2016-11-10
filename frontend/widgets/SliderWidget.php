<?php
namespace bl\slider\frontend\widgets;

use yii\base\Widget;

use bl\slider\common\entities\Slider;

/**
 * Widget for rendering the slider in frontend
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 *
 * @property string $sliderKey
 * @property array $slickSliderOptions
 */
class SliderWidget extends Widget
{
    /**
     * @var string Slider key
     */
    public $sliderKey;

    /**
     * @var string Pattern for image
     */
    public $imagePattern =
    '<div style="background: url({url}) {params} no-repeat; background-size: cover; height: 400px;"></div>';

    /**
     * @var array Configuration options for Slick slider
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

    public function init()
    {
        $this->_slider = Slider::find()
            ->where(['key' => $this->sliderKey])
            ->with('sliderContent')
            ->one();
    }

    public function run()
    {
        return $this->render('slider', [
            'slider' => $this->_slider,

            'slickSliderOptions' => json_encode($this->slickSliderOptions),
            'imagePattern' => $this->imagePattern
        ]);
    }

    public static function getImageByPattern($url, $params, $imagePattern)
    {
        return strtr($imagePattern, [
            '{url}' => $url,
            '{params}' => $params
        ]);
    }
}