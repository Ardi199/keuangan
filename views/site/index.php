<?php

use kartik\date\DatePicker;
use miloschuman\highcharts\Highcharts;
use kartik\form\ActiveForm;
use yii\helpers\Html;

$this->title = 'Rekap Pengeluaran';
?>
<div class="site-index">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 style="text-align: center">Dashboard Rekap Keuangan</h3>
        </div>
        <?php
        if (!Yii::$app->user->isGuest) :
        ?>
            <div class="panel-body">
                <?php $form = ActiveForm::begin(); ?>
                <div class="col-md-3">
                    <?= $form->field($searchModel, 'TANGGAL')->widget(DatePicker::classname(), [
                        'options' => ['placeholder' => 'Enter birth date ...', 'id' => 'dashboard'],
                        'pluginOptions' => [
                            'format' => 'yyyy',
                            'autoclose' => true,
                            'startView' => 'decade', // Tampilan awal widget adalah tampilan bulan
                            'minViewMode' => 'years', // Hanya izinkan pemilihan bulan
                        ]
                    ])->label(false); ?>
                </div>
                <?= Html::submitButton('<i class="fa fa-calendar-check-o"> Search</i>', ['class' => 'btn btn-primary']) ?>
                <?php ActiveForm::end(); ?>
                <div class="col-md-12">
                    <?=
                    Highcharts::widget([
                        'options' => [
                            'chart' => [
                                'type' => 'column',
                            ],
                            'title' => ['text' => 'Rekap Bulanan Pemasukan & Pengeluaran ' . $searchModel->TANGGAL],
                            'xAxis' => [
                                'categories' => ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                                'crosshair' => true
                            ],
                            'yAxis' => [
                                'title' => ['text' => 'Pemasukan']
                            ],
                            'series' => [
                                [
                                    'name' => 'Pemasukan',
                                    'data' => [
                                        $bulananPem['January'],
                                        $bulananPem['February'],
                                        $bulananPem['March'],
                                        $bulananPem['April'],
                                        $bulananPem['May'],
                                        $bulananPem['June'],
                                        $bulananPem['July'],
                                        $bulananPem['August'],
                                        $bulananPem['September'],
                                        $bulananPem['October'],
                                        $bulananPem['November'],
                                        $bulananPem['December']
                                    ]
                                ],
                                [
                                    'name' => 'Pengeluaran',
                                    'data' => [
                                        $bulananPeng['January'],
                                        $bulananPeng['February'],
                                        $bulananPeng['March'],
                                        $bulananPeng['April'],
                                        $bulananPeng['May'],
                                        $bulananPeng['June'],
                                        $bulananPeng['July'],
                                        $bulananPeng['August'],
                                        $bulananPeng['September'],
                                        $bulananPeng['October'],
                                        $bulananPeng['November'],
                                        $bulananPeng['December']
                                    ]
                                ],
                            ],
                        ]
                    ]);
                    ?>
                </div>
            </div>
        <?php else : ?>
            <div class="site-index">
                <h1 style="text-align: center;">Selamat Datang</h1><br>
                <h3 style="text-align: center;"><?= date('Y-m-l') ?></h3><br>
                <h5 style="text-align: center;"><?= date('h:i A') ?></h5>
            </div>
        <?php endif; ?>
    </div>
</div>