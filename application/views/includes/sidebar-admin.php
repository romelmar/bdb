<div class="col-sm-2">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Dashboard </h3>
        </div>
        <div class="panel-body">
            <ul class="nav nav-list">
                <?php foreach( $menu as $k => $v ): ?>
                    <li class="<?php echo $class[$k]; ?>">  <?php echo anchor($menu[$k]['url'],' <i class="'.$menu[$k]['icon'].'"></i> '. $menu[$k]['label'],$menu[$k]['attr']); ?> </li>
                <?php endforeach; ?>
            </ul>

        </div>
    </div>

</div>
<div class="col-sm-10">
