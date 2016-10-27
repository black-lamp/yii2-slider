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
 * @property string $imageHeight
 * @property boolean $imageCrop
 * @property array $slickSliderOptions
 */
class SliderWidget extends Widget
{
    /**
     * @var string Slider key
     */
    public $sliderKey;
    /**
     * @var string Height of block with image
     */
    public $imageHeight = '400px';
    /**
     * @var boolean if set `true` to block with image will be appended
     * CSS property `background-size: cover`. If set `false` - `background-size: contain`
     */
    public $imageCrop = false;
    /**
     * @var array Configuration options for Slick slider
     * @see http://kenwheeler.github.io/slick/ for more information
     */
    public $slickSliderOptions = [
        'slidesToShow' => '3',
        'slidesToScroll' => '1',
        'autoplay' => 'true',
        'autoplaySpeed' =>  '2000'
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

            'imageHeight' => $this->imageHeight,
            'imageCrop' => $this->imageCrop,
            'slickSliderOptions' => $this->slickSliderOptions
        ]);
    }
}