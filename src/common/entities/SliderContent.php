<?php
/**
 * @link https://github.com/black-lamp/yii2-slider
 * @copyright Copyright (c) Vladimir Kuprienko
 * @license BSD 3-Clause License
 */

namespace bl\slider\common\entities;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "slider_content".
 *
 * @property integer $id
 * @property integer $slider_id
 * @property string $content
 * @property string $params
 * @property integer $position
 * @property integer $is_image
 * @property string $alt
 *
 * @property Slider $slider
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 */
class SliderContent extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'slider_content';
    }

    public function rules()
    {
        return [
            ['content', 'string'],
            ['position', 'number']
        ];
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('slider.entity', 'ID'),
            'slider_id' => Yii::t('slider.entity', 'Slider ID'),
            'content' => Yii::t('slider.entity', 'Content'),
            'params' => Yii::t('slider.entity', 'Params'),
            'position' => Yii::t('slider.entity', 'Slide position')
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSlider()
    {
        return $this->hasOne(Slider::className(), ['id' => 'slider_id']);
    }
}
