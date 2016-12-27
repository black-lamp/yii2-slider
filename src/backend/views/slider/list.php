<?php
/**
 * @link https://github.com/black-lamp/yii2-slider
 * @copyright Copyright (c) Vladimir Kuprienko
 * @license BSD 3-Clause License
 */

use yii\helpers\Html;
use yii\helpers\Url;

use bl\slider\common\entities\Slider;
use bl\slider\backend\Module as SliderModule;

/**
 * View file for Slider controller
 *
 * @var Slider[] $sliders
 * @var array $slides
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 */

\yii\bootstrap\BootstrapAsset::register($this);

$this->params['breadcrumbs'][] = SliderModule::t('backend.breadcrumbs', 'Slider list');
?>

<div class="container">
    <h1 class="text-center">
        <?= SliderModule::t('backend.list', 'Sliders list') ?>
    </h1>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>
                            <?= SliderModule::t('backend.list', 'Key') ?>
                        </th>
                        <th>
                            <?= SliderModule::t('backend.list', 'Slides count') ?>
                        </th>
                        <th>
                            <?= SliderModule::t('backend.list', 'Actions') ?>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($sliders as $number => $slider): ?>
                        <tr>
                            <td>
                                <?= ++$number ?>
                            </td>
                            <td>
                                <?= $slider->key ?>
                            </td>
                            <td>
                                <?= count($slider->sliderContent) ?>
                            </td>
                            <td>
                                <?= Html::a(SliderModule::t('backend.button', 'Edit'),
                                    Url::toRoute([
                                        'slider/edit',
                                        'sliderId' => $slider->id
                                    ]),
                                    [ 'class' => 'btn btn-xs btn-warning' ]) ?>
                                <?= Html::a(SliderModule::t('backend.button', 'Delete'),
                                    Url::toRoute([
                                        'slider/delete',
                                        'sliderId' => $slider->id
                                    ]),
                                    [ 'class' => 'btn btn-xs btn-danger' ]) ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <hr>
            <?= Html::a(SliderModule::t('backend.button', 'Create slider'),
                Url::toRoute('create'),
                [ 'class' => 'btn btn-success pull-right' ]) ?>
        </div>
    </div>
</div>
