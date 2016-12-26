<?php
/**
 * @link https://github.com/black-lamp/yii2-slider
 * @copyright Copyright (c) Vladimir Kuprienko
 * @license BSD 3-Clause License
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use bl\ace\AceWidget;
use bl\slider\backend\widgets\Error;
use bl\slider\backend\SliderModule;

/**
 * View file for Content controller
 *
 * @var \bl\slider\backend\models\forms\AddHtml $model
 * @var array $errors
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 */

\yii\bootstrap\BootstrapAsset::register($this);

$this->params['breadcrumbs'][] = [
    'label' => SliderModule::t('backend.breadcrumbs', 'Slider list'),
    'url' => ['/slider']
];
$this->params['breadcrumbs'][] = [
    'label' => SliderModule::t('backend.breadcrumbs', 'Edit slider'),
    'url' => ['slider/edit', 'sliderId' => $model->sliderId]
];
$this->params['breadcrumbs'][] = SliderModule::t('backend.breadcrumbs', 'Add content');
?>

<div class="container">
    <h1 class="text-center">
        <?= SliderModule::t('backend.content', 'Add HTML content') ?>
    </h1>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <?php if (!empty($errors)): ?>
                <?= Error::widget(['errors' => $errors]) ?>
            <?php endif; ?>
            <?php $form = ActiveForm::begin([
                    'enableClientValidation' => false
                ]) ?>
                <?= $form->field($model, 'position')
                        ->input('number', [
                            'min' => 1
                        ]) ?>
                <?= $form->field($model, 'content')->widget(AceWidget::className(), [
                    'enableEmmet' => true,
                    'attributes' => [
                        'style' => 'width: 100%; min-height: 400px;'
                    ]
                ])->label(SliderModule::t('backend.content', 'HTML content')) ?>
                <?= Html::submitButton(
                    SliderModule::t('backend.button', 'Add'),
                    [ 'class' => 'btn btn-success pull-right' ]
                ) ?>
            <?php $form->end() ?>
        </div>
    </div>
</div>
