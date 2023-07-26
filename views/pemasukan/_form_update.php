<?php

use kartik\date\DatePicker;
use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\datetime\DateTimePicker;
?>
<?php $form = ActiveForm::begin([
    'action' => ['pemasukan/update','id'=>$model->ID],
    'options' => [
        'enableAjaxValidation' => true,
        'enctype' => 'multipart/form-data'
    ]
]); ?>

<div class="pemasukan-form">

    <?= $form->field($model, 'NOMINAL')->textInput(['value'=>$model->NOMINAL]) ?>

    <?= $form->field($model, 'KETERANGAN')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TANGGAL')->widget(DateTimePicker::classname(), [
        'options' => ['placeholder' => 'Enter birth date ...'],
        'pluginOptions' => [
            'autoclose' => true,
        ]
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton('<i class="fa fa-check"> Update</i>', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>