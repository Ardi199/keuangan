<?php

use yii\helpers\Html;

$this->title = 'Update Test: ' . $model->ID;
?>
<div class="rekap-update">
    <h3><?= Html::encode($this->title) ?></h3>
    <?= $this->render('_form_update', [
        'model' => $model,
    ]) ?>
</div>