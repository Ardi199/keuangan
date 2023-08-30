<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Hutang $model */

$this->title = 'Update Hutang: ' . $model->ID;
?>
<div class="hutang-update">


    <div class="box box-info">
        <div class="box-body">
            <h3><?= Html::encode($this->title) ?></h3>
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>

</div>