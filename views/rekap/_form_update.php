<?php

use kartik\date\DatePicker;
use kartik\datetime\DateTimePicker;
use kartik\form\ActiveForm;
use yii\helpers\Html;

$form = ActiveForm::begin([
    'action' => ['rekap/update','id'=>$model->ID],
    'options' => [
        'enableAjaxValidation' => true,
        'enctype' => 'multipart/form-data'
    ]
]); ?>

<div class="rekap-form">
    <?= $form->field($model, 'NOMINAL')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'KETERANGAN')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TANGGAL')->widget(DateTimePicker::classname(), [
        'options' => ['placeholder' => 'Enter event time ...'],
        'pluginOptions' => [
            'autoclose' => true
        ]
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton('<i class="fa fa-plus"> Update</i>', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>