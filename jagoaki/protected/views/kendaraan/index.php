<?php
/* @var $this KendaraanController */

$this->breadcrumbs=array(
	'Kendaraan',
);
?>
<h1>Data Master Kendaraan</h1>
    <br />
    <br />
    <div class="row-fluid">
                <ul class="thumbnails ">
                  
                  <li class="">
                    <a href="<?php echo Yii::app()->createUrl('kendaraan/admin');?>/"   class="thumbnail">
                    <div class="background"><img src="<?php echo Yii::app()->request->baseUrl;?>/img/icons/kendaraan/master.png" alt="" class="img-polaroid"></div>
                    </a>
                      
                    <h3>Kendaraan</h3>
                  </li>
                  
                  <li class="">
                    <a href="<?php echo Yii::app()->createUrl('bahanBakar');?>/admin"   class="thumbnail">
                    <div class="background">
                        <img src="<?php echo Yii::app()->request->baseUrl;?>/img/icons/kendaraan/fuel.png" alt="" class="img-polaroid"> 
                    </div>    
                    </a>
                    <h3>Bahan Bakar</h3>

                  </li>
                  
                  <li class="">
                    <a href="<?php echo Yii::app()->createUrl('kategoriKendaraan');?>/admin"   class="thumbnail">
                    <div class="background">
                        <img src="<?php echo Yii::app()->request->baseUrl;?>/img/icons/kendaraan/category.png" alt="" class="img-polaroid">
                        
                    </div>                    
                    </a>
                    <h3>Kategori</h3>
                  </li>
                  
                  <li class="">
                    <a href="<?php echo Yii::app()->createUrl('jenisKendaraan');?>/admin"   class="thumbnail">
                    <div class="background">
                        <img src="<?php echo Yii::app()->request->baseUrl;?>/img/icons/kendaraan/jenis.png" alt="" class="img-polaroid">
                                           
                    </div>
                    </a>
                    <h3>Jenis</h3> 
                      

                  </li>
                  
                  <li class="">
                    <a href="<?php echo Yii::app()->createUrl('merkKendaraan');?>/admin"   class="thumbnail">
                    <div class="background">
                        <img src="<?php echo Yii::app()->request->baseUrl;?>/img/icons/kendaraan/merk.png" alt="" class="img-polaroid">
                        
                    </div>
                    </a>
                    <h3>Merk</h3>
                  </li>
                  
                  <li class="">
                    <a href="<?php echo Yii::app()->createUrl('detailKendaraan');?>/admin"   class="thumbnail">
                    <div class="background">
                        <img src="<?php echo Yii::app()->request->baseUrl;?>/img/icons/kendaraan/car.png" alt="" class="img-polaroid">
                        
                    </div>
                    </a>
                    <h3>Detail</h3>
                  </li>
                  
                  <li class="">
                    <a href="<?php echo Yii::app()->createUrl('tipeKendaraan');?>/admin"   class="thumbnail">
                    <div class="background">
                        <img src="<?php echo Yii::app()->request->baseUrl;?>/img/icons/kendaraan/car.png" alt="" class="img-polaroid">
                        
                    </div>
                    </a>
                    <h3>Tipe Kendaraan</h3>
                  </li>
                  
                </ul>
    </div><!--/row-fluid-->
