<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

use bl\slider\common\entities\SliderContent;
use bl\slider\backend\SliderModule;
use bl\slider\backend\models\UploadImage;

/**
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 *
 * @var yii\web\View $this
 * @var SliderContent $slider_content
 * @var integer $slider_id
 * @var UploadImage $upload_image
 * @var array $errors
 */

\yii\bootstrap\BootstrapAsset::register($this);

$this->params['breadcrumbs'][] = [
    'label' => SliderModule::t('backend.breadcrumbs', 'Slider list'),
    'url' => ['/slider']
];
$this->params['breadcrumbs'][] = [
    'label' => SliderModule::t('backend.breadcrumbs', 'Edit slider'),
    'url' => ['slider/edit', 'sliderId' => $slider_id]
];
$this->params['breadcrumbs'][] = SliderModule::t('backend.breadcrumbs', 'Add content');
?>

<div class="container">
    <h1 class="text-center">
        <?= SliderModule::t('backend.content', 'Add image') ?>
    </h1>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <?php if(!empty($errors)) {
                echo $this->render('_errors', [
                    'errors' => $errors
                ]);
            } ?>

            <?php
            /** @var ActiveForm $form */
            $form = ActiveForm::begin([
                'enableClientValidation' => false,
                'options' => ['enctype' => 'multipart/form-data']
            ])
            ?>
                <?= $form->field($slider_content, 'slider_id')
                    ->hiddenInput(['value' => $slider_id])
                    ->label(false) ?>
                <?= $form->field($slider_content, 'position')
                        ->input('number', [
                            'min' => 1
                        ]) ?>
                <?= $form->field($slider_content, 'content')
                        ->input('text')
                        ->label(
                            SliderModule::t('backend.content', 'Path to image file...')
                        ) ?>
                <div class="form-group">
                    <?= $form->field($upload_image, 'imageFile')
                            ->fileInput()
                            ->label(
                                SliderModule::t('backend.content', 'or upload new file')
                            ) ?>
                </div>
                <?= $form->field($slider_content, 'params')
                        ->input('text') ?>
                <?= Html::submitButton(
                    SliderModule::t('backend.button', 'Add'),
                    [ 'class' => 'btn btn-success pull-right' ]
                ) ?>
            <?php $form->end() ?>
        </div>
    </div>
</div>
