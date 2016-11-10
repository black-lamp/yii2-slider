<?php
use yii\helpers\Html;

use bl\slider\frontend\widgets\SliderWidget;
use bl\slider\frontend\assets\SlickAsset;
use bl\slider\common\entities\Slider;

/**
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 *
 * @var yii\web\View $this
 * @var Slider $slider
 * @var string $imagePattern
 * @var array $slickSliderOptions
 */

SlickAsset::register($this);
$this->registerJs("$('#$slider->key').slick($slickSliderOptions);");
?>

<?php if(!empty($slider)): ?>
    <?= Html::beginTag('div', [
        'id' => $slider->key,
        'class' => 'slider'
    ]) ?>
        <?php foreach ($slider->sliderContent as $slide): ?>
            <div class="slide">
                <?php if($slide->is_image): ?>
                    <?= SliderWidget::getImageByPattern($slide->content, $slide->params, $imagePattern) ?>
                <?php else: ?>
                    <?= $slide->content ?>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    <?= Html::endTag('div') ?>
<?php endif; ?>
