<?php
/**
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 *
 * @var array $errors
 */
?>

<div class="alert alert-danger alert-dismissible fade in" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
    <?php foreach ($errors as $error): ?>
        <?php foreach ($error as $msg): ?>
            <p><?= $msg ?></p>
        <?php endforeach; ?>
    <?php endforeach; ?>
</div>
