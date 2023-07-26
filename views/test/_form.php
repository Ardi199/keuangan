<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<div class="test-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ID')->textInput() ?>

    <?= $form->field($model, 'TEST')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>