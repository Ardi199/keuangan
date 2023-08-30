<?php

use yii\helpers\Html;
?>
<aside class="main-sidebar">

    <section class="sidebar">

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget' => 'tree'],
                'items' => [
                    [
                        'label' => 'Dashboard', 
                        'icon' => 'dashboard',
                        'url' => ['/site/index']
                    ],
                    [
                        'label' => 'Pengeluaran', 
                        'icon' => 'money',
                        'items' => [
                            [
                                'label' => 'Harian',
                                'url' => ['/rekap/index']
                            ],
                            [
                                'label' => 'Bulanan',
                                'url' => ['/rekap/index-bulanan']
                            ]
                        ]
                    ],
                    [
                        'label' => 'Pemasukan', 
                        'icon' => 'money',
                        'url' => ['/pemasukan/index']
                    ],
                    [
                        'label' => 'Hutang', 
                        'icon' => 'handshake-o',
                        'items' => [
                            [
                                'label' => 'Monitoring',
                                'icon' => 'desktop',
                                'url' => ['/hutang/index']
                            ],
                            [
                                'label' => 'Approval',
                                'icon' => 'check-square-o',
                                'url' => ['/hutang/approval']
                            ]
                        ]
                    ],
                    [
                        'label' => 'Data Pengguna',
                        'icon' => 'user',
                        'visible' => Yii::$app->user->identity->JENIS_USER == '0',
                        'url' => ['/data-pengguna/index']
                    ]
                ],
            ]
        ) ?>

    </section>

</aside>