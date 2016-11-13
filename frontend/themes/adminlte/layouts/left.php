<?php

use yii\helpers\Url;
use yii\helpers\Html;
?>
<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/jub001.png" class="img-circle" alt="User Image"/>
            </div>
             <div class="pull-left info">
                <?php if (Yii::$app->user->isGuest) { ?>
                    <p>Guest</p>
                    <a href="#"><i class="fa fa-circle text-red"></i> Offline</a>
                <?php } else { ?>
                    <p><?= Yii::$app->user->identity->tname ?></p>
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                <?php } ?>


            </div>
        </div>

        <!-- search form -->

        <!-- /.search form -->
        <ul class="sidebar-menu">



            <li>
                <a href="<?= Url::to('index.php?r=site') ?>">
                    <i class="fa fa-th "></i> <span>&nbsp;Dashboard</span>
                    <span class="pull-right-container">
                        <small class="label pull-right bg-green">new</small>
                    </span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fa fa-bookmark-o  fa-lg  " style="color:greenyellow;"></i> <span>ตัวชี้วัด KPI</span>

                </a>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-bookmark-o fa-lg" style="color:blueviolet;"></i> <span>การเกิดอุบัติเหตุ</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>

                </a>
                <ul class="treeview-menu">
                    <li><a href="<?= Url::to('index.php?r=kpireport/iadmit') ?>"><i class="fa fa-circle-o"></i><span class="pull-right-container">
                                <span data-toggle="tooltip" title="-_-" class="badge bg-gray pull-right">0</span>
                            </span>Admit</a></li>
                    <li><a href="<?= Url::to('index.php?r=kpireport/iinjury') ?>"><i class="fa fa-circle-o"></i><span class="pull-right-container">
                                 <span data-toggle="tooltip" title="-_-" class="badge bg-gray pull-right">0</span>
                            </span>บาดเจ็บ</a></li>
                    <li><a href="<?= Url::to('index.php?r=kpireport/ideath') ?>"><i class="fa fa-circle-o"></i><span class="pull-right-container">
                               <span data-toggle="tooltip" title="-_-" class="badge bg-gray pull-right">0</span>
                            </span>เสียชีวิต</a></li>

                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-bookmark-o fa-lg" style="font-size:20px;color:#ff3399;"></i> <span>ประเภทการเกิดอุบัติเหตุ</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>

                </a>
                <ul class="treeview-menu">
                    <li><a href="<?= Url::to('index.php?r=kpireport/vinjury') ?>"><i class="fa fa-circle-o"></i><span class="pull-right-container">
                                <span data-toggle="tooltip" title="-_-" class="badge bg-gray pull-right">0</span>
                            </span>บาดเจ็บ</a></li>
                    <li><a href="<?= Url::to('index.php?r=kpireport/vdeath') ?>"><i class="fa fa-circle-o"></i><span class="pull-right-container">
                                 <span data-toggle="tooltip" title="-_-" class="badge bg-gray pull-right">0</span>
                            </span>เสียชีวิต</a></li>

                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-bookmark-o fa-lg" style="color:#00ccff;"></i> <span>19 สาเหตุการเกิดอุบัติเหตุ</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>

                </a>
                <ul class="treeview-menu">
                     <li><a href="<?= Url::to('index.php?r=kpireport/causeinjury') ?>"><i class="fa fa-circle-o"></i><span class="pull-right-container">
                                <span data-toggle="tooltip" title="-_-" class="badge bg-gray pull-right">0</span>
                            </span>บาดเจ็บ</a></li>
                    <li><a href="<?= Url::to('index.php?r=kpireport/causedeath') ?>"><i class="fa fa-circle-o"></i><span class="pull-right-container">
                                 <span data-toggle="tooltip" title="-_-" class="badge bg-gray pull-right">0</span>
                            </span>เสียชีวิต</a></li>

                </ul>
            </li>

            <li class="header"></li>
            <li><a href="<?= Url::to('/skacc/backend/web') ?>" target="_blank"><i class="fa fa-circle-o text-aqua" ></i> <span>ผู้ดูแลระบบ</span></a></li>

            <?php
            $cid = '';
            if (Yii::$app->user->isGuest) {
                ?>
                <li><a href="<?= Url::to('index.php?r=site/login') ?>"><i class="fa fa-circle-o text-green"></i> <span>เข้าสูระบบ</span></a></li>
                <?php } else { ?>
                <li>
                    <?php
                    echo Html::a('<i class="fa fa-circle-o text-red"></i>ออกจากระบบ', ['/site/logout'], [
                        'data' => [
                            'icon' => 'fa fa-circle-o text-red',
                            'method' => 'post',
                        ],
                            ]
                    );
                    ?>


                </li>
            <?php } ?>


        </ul>

    </section>

</aside>
