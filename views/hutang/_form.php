<?php

use kartik\form\ActiveForm;
use yii\helpers\Html;
use kartik\file\FileInput;
use kartik\select2\Select2;

$form = ActiveForm::begin([
    'action' => ['hutang/create'],
    'options' => [
        'enableAjaxValidation' => true,
        'enctype' => 'multipart/form-data'
    ]
]);
?>

<div class="hutang-form">

    <?= $form->field($model, 'KETERANGAN')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'NOMINAL')->textInput() ?>

    <?= $form->field($model, 'STATUS')->widget(Select2::classname(), [
        'data' => ['Belum di Bayar' => 'Belum di Bayar', 'Sudah di Bayar' => 'Sudah di Bayar'],
        'options' => ['placeholder' => 'Status ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'BUKTI')->widget(FileInput::classname(), [
        'options' => ['accept' => 'image/*'],
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>