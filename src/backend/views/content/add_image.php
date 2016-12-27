<?php
/**
 * @link https://github.com/black-lamp/yii2-slider
 * @copyright Copyright (c) Vladimir Kuprienko
 * @license BSD 3-Clause License
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use bl\slider\backend\widgets\Error;
use bl\slider\backend\Module as Slider;
use bl\slider\backend\models\UploadImage;

/**
 * View file for Content controller
 *
 * @var \yii\web\View $this
 * @var \bl\slider\backend\models\forms\AddImage $addImageForm
 * @var UploadImage $uploadImage
 * @var array $errors
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 */

\yii\bootstrap\BootstrapAsset::register($this);

$this->params['breadcrumbs'][] = [
    'label' => Slider::t('backend.breadcrumbs', 'Slider list'),
    'url' => ['/slider']
];
$this->params['breadcrumbs'][] = [
    'label' => Slider::t('backend.breadcrumbs', 'Edit slider'),
    'url' => ['slider/edit', 'sliderId' => $addImageForm->sliderId]
];
$this->params['breadcrumbs'][] = Slider::t('backend.breadcrumbs', 'Add content');
?>

<div class="container">
    <h1 class="text-center">
        <?= Slider::t('backend.content', 'Add image') ?>
    </h1>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <?php if (!empty($errors)): ?>
                <?= Error::widget(['errors' => $errors]) ?>
            <?php endif; ?>
            <?php $form = ActiveForm::begin([
                'options' => ['enctype' => 'multipart/form-data'],
                'enableClientValidation' => false
            ]) ?>
                <?= $form->field($addImageForm, 'position')
                        ->input('number', [
                            'min' => 1
                        ]) ?>
                <?= $form->field($addImageForm, 'content')
                        ->label(Slider::t('backend.content', 'Path to image file...')) ?>
                <div class="form-group">
                    <?= $form->field($uploadImage, 'imageFile')
                            ->fileInput()
                            ->label(Slider::t('backend.content', 'or upload new file')) ?>
                </div>
                <?= $form->field($addImageForm, 'alt') ?>
                <?= $form->field($addImageForm, 'params') ?>
                <?= Html::submitButton(
                    Slider::t('backend.button', 'Add'),
                    [ 'class' => 'btn btn-success pull-right' ]
                ) ?>
            <?php $form->end() ?>
        </div>
    </div>
</div>
