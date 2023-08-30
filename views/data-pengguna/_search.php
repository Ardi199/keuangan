<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\DataPenggunaSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="data-pengguna-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ID_PENGGUNA') ?>

    <?= $form->field($model, 'USERNAME') ?>

    <?= $form->field($model, 'PASSWORD') ?>

    <?= $form->field($model, 'STATUS_USER') ?>

    <?= $form->field($model, 'JENIS_USER') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
