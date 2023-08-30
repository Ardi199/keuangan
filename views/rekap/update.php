<?php

use yii\helpers\Html;

$this->title = 'Update Pengeluaran: ' . $model->ID;
?>
<div class="box box-info">
    <div class="box-body">
        <h3><?= Html::encode($this->title) ?></h3>
        <?= $this->render('_form_update', [
            'model' => $model,
        ]) ?>
    </div>
</div>