<?php

use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */
?>

<header class="main-header">

    <div class="logo">
        <a href="#" style="color:white!important;"><i class="glyphicon glyphicon-asterisk"></i> Keuangan</a>
    </div>

    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">
                <li class="dropdown user">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <span class="hidden-xs"><i class="glyphicon glyphicon-user"></i> <?= Yii::$app->user->identity->nama_pengguna ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- Menu Footer-->
                        <li class="user-footer primary">
                            <div class="text-center">
                                <?= Html::a(
                                    '<i class="glyphicon glyphicon-log-out"></i> Logout',
                                    ['/site/logout'],
                                    ['data-method' => 'post', 'class' => 'btn btn-primary btn-flat'],
                                    ['visible' => !Yii::$app->user->isGuest]
                                ) ?>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>