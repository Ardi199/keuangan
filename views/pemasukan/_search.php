<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\PemasukanSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="pemasukan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ID') ?>

    <?= $form->field($model, 'NOMINAL') ?>

    <?= $form->field($model, 'KETERANGAN') ?>

    <?= $form->field($model, 'CREATED_AT') ?>

    <?= $form->field($model, 'UPDATED_AT') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
