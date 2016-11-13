<?php

use yii\helpers\Url;
use yii\helpers\Html;
?>
<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p>Guest</p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
                <span class="input-group-btn">
                    <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </form>
        <!-- /.search form -->
        <ul class="sidebar-menu">
            <li class="header">MAIN MENU</li>


            <li>
                <a href="<?= Url::to('index.php?r=site') ?>">
                    <i class="fa fa-th"></i> <span>Dashboard</span>
                    <span class="pull-right-container">
                        <small class="label pull-right bg-green">new</small>
                    </span>
                </a>
            </li>
            <li>
                <a href="<?= Url::to('index.php?r=searchbank') ?>">
                    <i class="fa fa-search"></i> <span>ตัวชี้วัด KPI</span>

                </a>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-address-card-o"></i> <span>ระบบรายงาน</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>

                </a>
                <ul class="treeview-menu">
                    <li><a href="<?= Url::to('index.php?r=eh') ?>"><i class="fa fa-circle-o"></i><span class="pull-right-container">
                                <small class="label pull-right bg-orange">14</small>
                            </span>เอ๊ะ!!!</a></li>

                </ul>
            </li>

            <li class="header"></li>
            <li><a href="<?= Url::to('/swdata/backend/web') ?>" target="_blank"><i class="fa fa-circle-o text-aqua" ></i> <span>ผู้ดูแลระบบ</span></a></li>

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
