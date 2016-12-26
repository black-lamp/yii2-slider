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
 * This is the model class for table "slider".
 *
 * @property integer $id
 * @property string $key
 * @property string $entity_id
 * @property string $entity_name
 *
 * @property SliderContent[] $sliderContent
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 */
class Slider extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'slider';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['key'], 'required'],
            [['key'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('slider.entity', 'ID'),
            'key' => Yii::t('slider.entity', 'Key')
        ];
    }

    /**
     * @inheritdoc
     * @return SliderActiveQuery
     */
    public static function find()
    {
        return Yii::createObject(SliderActiveQuery::className(), [get_called_class()]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSliderContent()
    {
        return $this->hasMany(SliderContent::className(), ['slider_id' => 'id']);
    }
}
