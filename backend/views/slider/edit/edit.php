<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

use bl\slider\common\entities\Slider;
use bl\slider\backend\SliderModule;

/**
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 *
 * @var Slider $slider
 */

\yii\bootstrap\BootstrapAsset::register($this);

$this->params['breadcrumbs'][] = [
    'label' => SliderModule::t('backend.breadcrumbs', 'Slider list'),
    'url' => ['/slider']
];
$this->params['breadcrumbs'][] = SliderModule::t('backend.breadcrumbs', 'Edit slider');
?>

<div class="container">
    <h1 class="text-center">
        <?= SliderModule::t('backend.edit', 'Edit slider') ?>
    </h1>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <?php
                /** @var ActiveForm $form */
                $form = ActiveForm::begin([
                    'enableClientValidation' => false
                ])
            ?>
                <?= $form->field($slider, 'key') ?>
                <?= Html::submitButton(
                    SliderModule::t('backend.button', 'Save'),
                    [ 'class' => 'btn btn-success pull-right' ]
                ) ?>
                <div class="clearfix"></div>
            <?php $form->end() ?>

            <h2 class="text-center">
                <?= SliderModule::t('backend.edit', 'Slides') ?>
            </h2>
            <hr>
            <div class="pull-right">
                <?= Html::a(SliderModule::t('backend.button', 'Add HTML content'),
                    Url::toRoute([
                        '/slider/content/add-html',
                        'sliderId' => $slider->id
                    ]),
                    [ 'class' => 'btn btn-sm btn-default' ]) ?>
                <?= Html::a(SliderModule::t('backend.button', 'Add image'),
                    Url::toRoute([
                        '/slider/content/add-image',
                        'sliderId' => $slider->id
                    ]),
                    [ 'class' => 'btn btn-sm btn-default' ]) ?>
            </div>
            <div class="clearfix"></div>
            <hr>
            <?= $this->render('_content', [
                'content' => $slider->sliderContent
            ]) ?>
        </div>
    </div>
</div>
