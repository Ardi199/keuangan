<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\DataPengguna $model */

$this->title = 'Buat Data Pengguna';
?>
<div class="data-pengguna-create">
    <div class="box box-primary">
        <div class="box-body">

        <h3><?= Html::encode($this->title) ?></h3>

        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
        </div>
    </div>
</div>
