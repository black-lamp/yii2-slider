<?php
/**
 * @link https://github.com/black-lamp/yii2-slider
 * @copyright Copyright (c) Vladimir Kuprienko
 * @license BSD 3-Clause License
 */

/**
 * View for \bl\slider\backend\widgets\Error widget
 *
 * @var \yii\web\View $this
 * @var array $errors
 **
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 */

\yii\bootstrap\BootstrapAsset::register($this);
?>

<?php foreach($errors as $fieldErrors): ?>
    <?php foreach($fieldErrors as $error): ?>
        <div class="alert alert-danger alert-dismissible fade in" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <?= $error ?>
        </div>
    <?php endforeach; ?>
<?php endforeach; ?>
