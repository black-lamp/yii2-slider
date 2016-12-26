<?php
/**
 * @link https://github.com/black-lamp/yii2-slider
 * @copyright Copyright (c) Vladimir Kuprienko
 * @license BSD 3-Clause License
 */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

use bl\ace\AceWidget;
use bl\slider\common\entities\SliderContent;
use bl\slider\backend\SliderModule;

/**
 * View file for Slider controller
 *
 * @var SliderContent[] $content
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 */

\yii\bootstrap\BootstrapAsset::register($this);
?>

<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
<?php foreach ($content as $number => $slide): ?>
    <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="heading-<?= $number ?>">
            <h4 class="panel-title">
                <a role="button"
                   data-toggle="collapse"
                   data-parent="#accordion"
                   href="#collapse-<?= $number ?>"
                   aria-expanded="true"
                   aria-controls="collapse-<?= $number ?>">
                    <?= sprintf("%s #%d",
                        SliderModule::t('backend.edit', 'Slide'),
                        $number + 1)  ?>
                </a>
                <?= Html::a(
                    SliderModule::t('backend.button', 'Delete'),
                    Url::toRoute([
                        '/slider/content/delete',
                        'id' => $slide->id
                    ]),
                    ['class' => 'text-danger pull-right']
                ) ?>
            </h4>
        </div>
        <div id="collapse-<?= $number ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading-<?= $number ?>">
            <div class="panel-body">
                <?php
                    /** @var ActiveForm $form */
                    $form = ActiveForm::begin([
                        'enableClientValidation' => false,
                        'action' => ["/slider/content/edit?id=$slide->id"]
                    ])
                ?>
                    <?= $form->field($slide, 'position')
                            ->input('number', [
                                'min' => 1
                            ]) ?>
                    <div class="form-group">
                        <?php if($slide->is_image): ?>
                            <?= $form->field($slide, 'alt') ?>
                            <?= $form->field($slide, 'params')
                                ->label(
                                    SliderModule::t('backend.edit', 'Params')
                                ) ?>
                            <?= Html::img($slide->content, [
                                'class' => 'img-thumbnail',
                                'style' => 'width: 100%;'
                            ]) ?>
                        <?php else: ?>
                            <?= $form->field($slide, 'content')
                                ->widget(AceWidget::className(), [
                                    'enableEmmet' => true,
                                    'attributes' => [
                                        'style' => 'width: 100%; min-height: 400px;'
                                    ]
                                ])
                                ->label(SliderModule::t('backend.edit', 'HTML content')) ?>
                        <?php endif; ?>
                    </div>
                    <?= Html::submitButton(
                        SliderModule::t('backend.button', 'Save changes'),
                        [ 'class' => 'btn btn-success pull-right' ]
                    ) ?>
                <?php $form->end() ?>
            </div>
        </div>
    </div>
<?php endforeach; ?>
</div>
