<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
?>

<div class="data-pengguna-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'USERNAME')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PASSWORD')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'NAMA_PENGGUNA')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'STATUS_USER')->widget(Select2::classname(), [
        'data' => ['1' => 'Aktif', '2' => 'Tidak Aktif'],
        'options' => ['placeholder' => 'Status User ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'JENIS_USER')->widget(Select2::classname(), [
        'data' => ['0' => 'Admin', '1' => 'User'],
        'options' => ['placeholder' => 'Jenis User ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
