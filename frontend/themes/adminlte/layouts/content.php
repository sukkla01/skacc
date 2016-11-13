<?php
use yii\widgets\Breadcrumbs;
use dmstr\widgets\Alert;

?>
<div class="content-wrapper">
    

    <section class="content">
        <?= Alert::widget() ?>
        <?= $content ?>
        <img src="../web/images/black_ribbon_bottom_right.png" class="black-ribbon stick-bottom stick-right"/>
    </section>
</div>

<footer class="main-footer">
    <div class="pull-right hidden-xs">
        <b>Version</b> 2.0
    </div>
    <strong>Copyright &copy; 2016-2017 <a href="https://www.facebook.com/jub.wifi" target="_blank">JubWiFi</a>.</strong> 
</footer>

<!-- Control Sidebar -->

<!-- Add the sidebar's background. This div must be placed
     immediately after the control sidebar -->
<div class='control-sidebar-bg'></div>