<?php
/**
 * @link https://github.com/black-lamp/yii2-slider
 * @copyright Copyright (c) Vladimir Kuprienko
 * @license BSD 3-Clause License
 */

namespace bl\slider\common\entities;

use yii\db\ActiveQuery;

/**
 * Extended ActiveQuery class for Slider entity
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 */
class SliderActiveQuery extends ActiveQuery
{
    /**
     * Method for appending SlideContent entities to Slider entity
     *
     * @param array $orderBy sorting params
     * @return $this
     */
    public function withSlides($orderBy = [])
    {
        if(empty($orderBy)) {
            $this->with('sliderContent');
        }
        else {
            $this->with(['sliderContent' => function($query) use ($orderBy) {
                /** @var ActiveQuery $query */
                $query->orderBy($orderBy);
            }]);
        }

        return $this;
    }

    /**
     * Method for getting Slide entity by key
     *
     * @param string $key
     * @return $this
     */
    public function key($key)
    {
        $this->where(['key' => $key]);

        return $this;
    }
}