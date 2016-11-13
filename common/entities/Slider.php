<?php
namespace bl\slider\common\entities;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "slider".
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 *
 * @property integer $id
 * @property string $key
 * @property string $entity_id
 * @property string $entity_name
 *
 * @property SliderContent[] $sliderContent
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
            'id' => 'ID',
            'key' => 'Key',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSliderContent()
    {
        return $this->hasMany(SliderContent::className(), ['slider_id' => 'id']);
    }
}
