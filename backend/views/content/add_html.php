<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

use bl\ace\AceWidget;
use bl\slider\common\entities\SliderContent;
use bl\slider\backend\SliderModule;

/**
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 *
 * @var SliderContent $slider_content
 * @var integer $slider_id
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
        <?= SliderModule::t('backend.content', 'Add HTML content') ?>
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
                    'enableClientValidation' => false
                ])
            ?>
                <?= $form->field($slider_content, 'slider_id')
                        ->hiddenInput(['value' => $slider_id])
                        ->label(false) ?>
                <?= $form->field($slider_content, 'position')
                        ->input('number', [
                            'min' => 1
                        ]) ?>
                <?= $form->field($slider_content, 'content')->widget(AceWidget::className(), [
                    'enableEmmet' => true,
                    'attributes' => [
                        'style' => 'width: 100%; min-height: 400px;'
                    ]
                ])->label(
                    SliderModule::t('backend.content', 'HTML content')
                ) ?>
                <?= Html::submitButton(
                    SliderModule::t('backend.button', 'Add'),
                    [ 'class' => 'btn btn-success pull-right' ]
                ) ?>
            <?php $form->end() ?>
        </div>
    </div>
</div>
