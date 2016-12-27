<?php
/**
 * @link https://github.com/black-lamp/yii2-slider
 * @copyright Copyright (c) Vladimir Kuprienko
 * @license BSD 3-Clause License
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use bl\slider\common\entities\Slider;
use bl\slider\backend\Module as SliderModule;

/**
 * View file for Slider controller
 *
 * @var Slider $slider
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 */

\yii\bootstrap\BootstrapAsset::register($this);

$this->params['breadcrumbs'][] = [
    'label' => SliderModule::t('backend.breadcrumbs', 'Slider list'),
    'url' => ['/slider']
];
$this->params['breadcrumbs'][] = SliderModule::t('backend.breadcrumbs', 'Create slider');
?>

<div class="container">
    <h1 class="text-center">
        <?= SliderModule::t('backend.create', 'Create slider') ?>
    </h1>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <?php
                /** @var ActiveForm $form */
                $form = ActiveForm::begin()
            ?>
                <?= $form->field($slider, 'key') ?>
                <?= Html::submitButton(SliderModule::t('backend.buttoon', 'Create'), [
                    'class' => 'btn btn-success pull-right'
                ]) ?>
            <?php $form->end() ?>
        </div>
    </div>
</div>
