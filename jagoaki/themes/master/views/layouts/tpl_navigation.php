<?php $user = Yii::app()->user; ?>
<div class="navbar-inner">
    <div class="container-fluid">
        <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-bar"></span>
         <span class="icon-bar"></span>
         <span class="icon-bar"></span>
        </a>
        <a class="brand" href="#">Admin Panel</a>
        <div class="nav-collapse collapse">
            <ul class="nav pull-right">
                <li class="dropdown">
                    <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown"> 
                        <i class="icon-user"></i> <?php if(isset(Yii::app()->user->get()->id)){echo Yii::app()->user->get()->user->name;}else{echo "Guest";} ?> <i class="caret"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a tabindex="-1" href="<?php echo Yii::app()->createUrl('me/profile'); ?>">Profile</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <?php if(isset(Yii::app()->user->get()->user->id)){?>
                            <a href="<?php echo Yii::app()->createUrl('site/logout'); ?>">Logout</a>
                            <?php } else { ?>
                            <a href=""<?php echo Yii::app()->createUrl('site/login'); ?>">Login</a>
                            <?php } ?>
                        </li>
                    </ul>
                </li>
            </ul>
            <ul class="nav">
                <?php 
                    if($user->checkAccess('pimpinan')){
                ?>
                <li class="active">
                    <a href="#">Dashboard</a>
                </li>
                <?php } ?>
                <?php 
                    if($user->checkAccess('distributor_admin')){
                ?>
                <li class="">
                    <a href="#">Report</a>
                </li>
                <?php } ?>
                <?php 
                    if($user->checkAccess('admin')){
                ?>
                <li class="dropdown">
                    <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">Master <i class="caret"></i>

                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a tabindex="-1" href="<?php echo Yii::app()->createUrl('kendaraan/index'); ?>">Kendaraan</a>
                        </li>
                        <li>
                            <a tabindex="-1" href="<?php echo Yii::app()->createUrl('customer/index'); ?>">Customer</a>
                        </li>
                        <li>
                            <a tabindex="-1" href="<?php echo Yii::app()->createUrl('product/admin'); ?>">Product</a>
                        </li>
                        <li>
                            <a tabindex="-1" href="<?php echo Yii::app()->createUrl('productType/admin'); ?>">Tipe Produk</a>
                        </li>
                    </ul>
                </li>
                <?php } ?>
                <?php if($user->checkAccess('store_admin')){ ?>
                <li class="dropdown">
                    <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">Transaksi <i class="caret"></i>

                    </a>
                    <ul class="dropdown-menu">
                        <li class="dropdown-submenu">
                            <a tabindex="-1" href="#">Penjualan</a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a tabindex="-1" href="<?php echo Yii::app()->createUrl('penjualan/index/', array('ktp'=>'0')); ?>">Add New</a>
                                </li>
                                <li>
                                    <a tabindex="-1" href="<?php echo Yii::app()->createUrl('detailPenjualan/index'); ?>">Log Penjualan</a>
                                </li>
                                <li>
                                    <a tabindex="-1" href="<?php echo Yii::app()->createUrl('penjualan/cancel'); ?>">Cancel Invoice / Penjualan</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a tabindex="-1" href="<?php echo Yii::app()->createUrl('layanan/create'); ?>">Layanan</a>
                        </li>
                        <li>
                            <a tabindex="-1" href="<?php echo Yii::app()->createUrl('pembelian/index'); ?>">Pembelian</a>
                        </li>
                        <li>
                            <a tabindex="-1" href="<?php echo Yii::app()->createUrl('garansi/index'); ?>">Garansi</a>
                        </li>
                    </ul>
                </li>
                <?php } ?>
                <?php 
                    if($user->checkAccess('admin')){
                ?>
                <li class="dropdown">
                    <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">Users <i class="caret"></i>

                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a tabindex="-1" href="<?php echo Yii::app()->createUrl('user/create'); ?>">Add New</a>
                        </li>
                        <li>
                            <a tabindex="-1" href="<?php echo Yii::app()->createUrl('user/admin'); ?>">User List</a>
                        </li>
                        <li>
                            <a tabindex="-1" href="<?php echo Yii::app()->createUrl('organisation/admin'); ?>">Organisation</a>
                        </li>
                        <li>
                            <a tabindex="-1" href="<?php echo Yii::app()->createUrl('role/admin'); ?>">Roles</a>
                        </li>
                        <li>
                            <a tabindex="-1" href="<?php echo Yii::app()->createUrl('userRole/admin'); ?>">Permissions</a>
                        </li>
                        
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">Pegawai <i class="caret"></i>

                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a tabindex="-1" href="<?php echo Yii::app()->createUrl('pegawai/create'); ?>">Add New</a>
                        </li>
                        <li>
                            <a tabindex="-1" href="<?php echo Yii::app()->createUrl('pegawai/admin'); ?>">All</a>
                        </li>
                    </ul>
                </li>
                <?php } ?>
            </ul>
        </div>
        <!--/.nav-collapse -->
    </div>
</div>