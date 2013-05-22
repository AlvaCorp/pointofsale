<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'penjualan-form',
        'type'=>'horizontal',
        'enableAjaxValidation'=>false,
        'enableClientValidation'=>true,
        'clientOptions'=>array(
                'validateOnSubmit'=>true,
        ),
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>
        
	<?php //echo $form->errorSummary($model); ?>
        
        <?php if(Yii::app()->user->hasFlash('Success')): ?>

        <div class="alert alert-success">
            <?php echo Yii::app()->user->getFlash('Success'); ?>
        </div>

        <?php endif; ?>

	<?php echo $form->errorSummary($penjualan); ?>
        
        <!-- Form Penjualan -->
        <fieldset>
            <legend>Total Bruto</legend>
            <h3 class='well'>Rp. <?php echo $penjualan->total; ?></h3>
        </fieldset>
        
        
        <!-- Detail Penjualan -->
        <fieldset>
            <legend>Filtering</legend>
	<?php //echo $form->textFieldRow($detailPenjualan,'penjualan_id',array('class'=>'span5', 'value'=>$detailPenjualan->id)); ?>
            
        <?php echo $form->dropDownListRow($detailPenjualan,'merk_product_id', CHtml::listData(MerkProduct::model()->findAll(), 'id', 'name'),
                    array('prompt'=>'Pilih Merk',
                          'ajax' => array(
                          'type'=>'GET', 
                          'url'=>CController::createUrl('penjualan/loadproductcategory'),
                          'update'=>'#DetailPenjualan_product_category_id', 
                          'data'=>array('merk'=>'js:this.value'),
                          )
                    )                     
                ); ?>
            
        <?php echo $form->dropDownListRow($detailPenjualan, 'product_category_id', CHtml::listData(ProductCategory::model()->findAll(), 'id', 'name'),
                array('prompt'=>'Kategori Produk',
                    'ajax' => array(
                    'type'=>'GET', 
                    'url'=>CController::createUrl('penjualan/loadproduct'),
                    'update'=>'#DetailPenjualan_product_id', 
                    'data'=>array('cat'=>'js:this.value'),                            
                    )
                )); 
        ?>

        <?php
            /*
            echo $form->dropDownListRow($detailPenjualan, 'product_type_id', CHtml::listData(ProductType::model()->findAll(), 'id', 'name'),
                array('prompt'=>'Tipe Produk',
                    'ajax' => array(
                    'type'=>'GET', 
                    'url'=>CController::createUrl('penjualan/loadproduct'),
                    'update'=>'#DetailPenjualan_product_id', 
                    'data'=>array('product'=>'js:this.value'),                            
                    )
                ));
             * 
             */ 
        ?>
        </fieldset>
        
        <fieldset>
            <legend>Sale Items</legend>
            
        <?php 
            echo $form->hiddenField($penjualan, 'tipe_penjualan_id', array('class'=>'span5', 'value'=>5)); 
        ?>

        <?php echo $form->dropDownListRow($detailPenjualan, 'product_id', CHtml::listData(Product::model()->findAll(), 'id', 'name')); ?>

	<?php echo $form->textFieldRow($detailPenjualan,'jumlah',array('class'=>'span5', 'value'=>'1')); ?>
            
        <?php echo $form->datepickerRow($detailPenjualan,'tanggal_produksi',array('prepend'=>'<i class="icon-calendar"></i>')); ?>
            
        <?php echo $form->textFieldRow($detailPenjualan,'kode_produksi',array('class'=>'span5')); ?>

	<?php //echo $form->textFieldRow($detailPenjualan,'total_harga',array('class'=>'span5')); ?>
        </fieldset>
        <!-- End Of Detail Penjualan -->

        <!-- Form Penjualan -->
        <fieldset>
            <legend>Total Bruto</legend>
	<?php //echo $form->textFieldRow($penjualan,'parent_id',array('class'=>'span5')); ?>

	<?php echo $form->hiddenField($penjualan,'user_role_id',array('class'=>'span5', 'value'=>Yii::app()->user->get()->id)); ?>
        
        <?php //echo $form->textFieldRow($penjualan,'organisation_id',array('class'=>'span5', 'value'=>Yii::app()->user->role()->organisation_id)); ?>
            
	<?php //echo $form->textFieldRow($penjualan,'log_kendaraan_id',array('class'=>'span5')); ?>

	<?php echo $form->hiddenField($penjualan,'customer_id',array('class'=>'span5', 'value'=>$customer->id)); ?>

	<?php //echo $form->textFieldRow($penjualan,'kd_penjualan',array('class'=>'span5','maxlength'=>256)); ?>

	<?php //echo $form->textFieldRow($penjualan,'date',array('class'=>'span5')); ?>

	<?php //echo $form->textFieldRow($penjualan,'total',array('class'=>'span5','maxlength'=>32, 'disabled'=>true)); ?>
            <h3 class="well">Rp. <?php echo $penjualan->total; ?></h3>
	<?php //echo $form->textFieldRow($penjualan,'bayar',array('class'=>'span5','maxlength'=>32)); ?>
        <!-- End Of Penjualan -->
        </fieldset>
        

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$penjualan->isNewRecord ? 'Submit' : 'Submit',
                        'icon'  =>'icon-hdd'
		)); ?>
                <?php
                    if(isset($penjualan->code) && $penjualan->code!=''){
                ?>
		<?php $this->widget('bootstrap.widgets.TbButton',array(
                        'label' => 'Cetak',
                        'type'  => 'secondary',
                        'url'  => Yii::app()->createUrl('penjualan/cetak/', array('code'=>$penjualan->code)),
                        'icon'=>'icon-download-alt'
                ));?>
                <?php
                    }
                ?>
	</div>

<?php $this->endWidget(); ?>

<?php

$gridDataProvider = new CArrayDataProvider(DetailPenjualan::model()->findAll(array('with'=>'penjualan', 'condition'=>"Penjualan.code='$penjualan->code'")));
 
// $gridColumns
$gridColumns = array(
	array('name'=>'id', 'header'=>'#', 'htmlOptions'=>array('style'=>'width: 60px')),
        array(
            'name'=>'product.name', 
            'header'=>'Produk',
        ),
	array('name'=>'jumlah', 'header'=>'Jumlah'),
	array('name'=>'total_harga', 'header'=>'Total'),
	array(
		'htmlOptions' => array('nowrap'=>'nowrap'),
		'class'=>'bootstrap.widgets.TbButtonColumn',
                
                'template'=>"{update}{view}",
		'viewButtonUrl'=>null,
		'updateButtonUrl'=>null,
		//'deleteButtonUrl'=>null,
	)
);

$this->widget('bootstrap.widgets.TbGridView', array(
        'type'=>"striped bordered",
	'dataProvider'=>$gridDataProvider,
	//'template'=>"{items}",
	'columns'=>$gridColumns,
));
?>
