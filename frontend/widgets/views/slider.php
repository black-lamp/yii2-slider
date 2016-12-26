<?php
/**
 * @link https://github.com/black-lamp/yii2-slider
 * @copyright Copyright (c) Vladimir Kuprienko
 * @license BSD 3-Clause License
 */

use yii\helpers\Html;

use bl\slider\frontend\widgets\SliderWidget;

/**
 * View file for Slider widget
 *
 * @var \yii\web\View $this
 * @var \bl\slider\common\entities\Slider $slider
 * @var string $imagePattern
 * @var array $slickSliderOptions
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 */

\bl\slider\frontend\assets\SlickAsset::register($this);
?>

<?php if(!empty($slider)): ?>
    <?php $this->registerJs("$('#$slider->key').slick($slickSliderOptions);") ?>
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
