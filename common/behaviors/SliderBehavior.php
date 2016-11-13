<?php
namespace bl\slider\common\behaviors;

use yii\base\Behavior;
use yii\base\Exception;
use yii\db\ActiveRecord;
use yii\db\BaseActiveRecord;

use bl\slider\common\entities\Slider;
use bl\slider\common\entities\SliderContent;

/**
 * Slider behavior for ActiveRecord models
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 *
 * @property BaseActiveRecord $owner
 * @property Slider $slider
 * @property SliderContent[] $content
 * @property integer $owner_id
 * @property string $owner_name
 */
class SliderBehavior extends Behavior
{
    /**
     * @var Slider entity
     */
    protected $slider;

    /**
     * @var SliderContent[] entities
     */
    protected $content;

    /**
     * @var integer Primary key of owner entity
     */
    protected $owner_id;

    /**
     * @var string Class name of owner entity
     */
    protected $owner_name;

    /**
     * @inheritdoc
     */
    public function init()
    {
        if($this->owner != null) {
            $this->owner_id = $this->owner->getPrimaryKey();
            $this->owner_name = $this->owner->className();
        }

        $this->getSlider();
    }

    /**
     * @inheritdoc
     */
    public function events()
    {
        return [
            BaseActiveRecord::EVENT_AFTER_FIND => 'getSlider',
            BaseActiveRecord::EVENT_AFTER_INSERT => 'saveSlider',
            BaseActiveRecord::EVENT_AFTER_UPDATE => 'saveSlider'
        ];
    }

    /**
     * Getter for slider key
     *
     * @return string
     */
    public function getSliderKey()
    {
        return $this->slider->key;
    }

    /**
     * Setter for slider key
     *
     * @param string $key
     */
    public function setSliderKey($key)
    {
        $this->slider->key = $key;
    }

    /**
     * Setter for slider-content
     *
     * @param SliderContent|SliderContent[] $content
     */
    public function setSliderContent($content)
    {
        if(is_array($content)) {
            foreach ($content as $item) {
                $this->content[] = $item;
            }
        }
        else {
            $this->content[] = $content;
        }
    }

    /**
     * Getter for slider-content
     *
     * @return SliderContent[]
     */
    public function getSliderContent()
    {
        return $this->content;
    }

    /**
     * Method for start initialize of behavior
     */
    public function getSlider()
    {
        $this->slider = Slider::findOne([
            'entity_id' => $this->owner_id,
            'entity_name' => $this->owner_name
        ]);

        $this->content = SliderContent::findAll([
            'slider_id' => $this->slider->id
        ]);

        if ($this->slider == null) {
            $this->slider = new Slider();
        }
    }

    /**
     * Method for saving `Slider` and `SliderContent` entities to database
     *
     * @throws Exception
     */
    public function saveSlider()
    {
        if(empty($this->slider->entity_id)) {
            $this->slider->entity_id = $this->owner_id;
            $this->slider->entity_name = $this->owner_name;
        }

        $transaction = ActiveRecord::getDb()->beginTransaction();
        try {
            if($this->slider->validate() && $this->slider->save()) {
                if(!empty($this->content)) {
                    foreach($this->content as $content) {
                        $content->slider_id = $this->slider->id;
                        $content->validate();
                        $content->save();
                    }
                }
            }

            $transaction->commit();
        }
        catch (Exception $error) {
            $transaction->rollBack();
        }
    }
}
