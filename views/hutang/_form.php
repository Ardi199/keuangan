<?php

use kartik\form\ActiveForm;
use yii\helpers\Html;
use kartik\file\FileInput;
use kartik\select2\Select2;

$form = ActiveForm::begin([
    'action' => $model->isNewRecord ? ['hutang/create'] : ['hutang/update','id' => $model->ID],
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
        'options' => [
            'accept' => 'image/*',
            'id' => $model->isNewRecord ? 'create-berkas' : 'update-berkas',
        ],
        'pluginOptions' => [
           'autoReplace'=>true,
           'showUpload' => false,
           'showRemove' => false,
           'required'=> true,
           'validateInitialCount'=>true,
           'overwriteInitial'=>false,
           'initialPreview'=> empty($model->BUKTI) ? false : 'files/hutang/'.$model->BUKTI,
           'initialPreviewAsData'=>true,
           'allowedFileExtensions'=>['png','jpg','jpeg','pdf'],
       ]
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>