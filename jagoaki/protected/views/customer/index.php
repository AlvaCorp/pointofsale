<?php
/* @var $this KendaraanController */

$this->breadcrumbs=array(
	'Customer',
);
?>
<h1>Data Master Customer</h1>
    <br />
    <br />
    <div class="row-fluid">
                <ul class="thumbnails ">
                  
                  <li class="">
                    <a href="<?php echo Yii::app()->createUrl('customerCategory/admin');?>/"   class="thumbnail">
                    <div class="background"><img src="<?php echo Yii::app()->request->baseUrl;?>/img/icons/customer/category.png" alt="" class="img-polaroid"></div>
                    </a>
                      
                    <h3>Category</h3>
                  </li>
                  
                  <li class="">
                    <a href="<?php echo Yii::app()->createUrl('customerInfo');?>/admin"   class="thumbnail">
                    <div class="background">
                        <img src="<?php echo Yii::app()->request->baseUrl;?>/img/icons/customer/info.png" alt="" class="img-polaroid"> 
                    </div>    
                    </a>
                    <h3>Info</h3>

                  </li>
                  
                  <li class="">
                    <a href="<?php echo Yii::app()->createUrl('customer');?>/admin"   class="thumbnail">
                    <div class="background">
                        <img src="<?php echo Yii::app()->request->baseUrl;?>/img/icons/customer/master.png" alt="" class="img-polaroid">
                        
                    </div>                    
                    </a>
                    <h3>Customer</h3>
                  </li>         
                  
                </ul>
    </div><!--/row-fluid-->
