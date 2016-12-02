<?php
namespace bl\slider\common\entities;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "slider_content".
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
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

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['slider_id', 'content', 'position'], 'required'],
            [['slider_id', 'position', 'is_image'], 'integer'],
            [['content', 'alt'], 'string'],
            [['params'], 'string', 'max' => 255],
            [['alt'], 'string', 'max' => 255],
            [
                ['slider_id'], 'exist',
                'skipOnError' => true,
                'targetClass' => Slider::className(),
                'targetAttribute' => ['slider_id' => 'id']
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'slider_id' => 'Slider ID',
            'content' => 'Content',
            'params' => 'Params',
            'position' => 'Slide position',
            'is_image' => 'Is Image',
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
