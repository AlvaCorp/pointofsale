	<?php if(Yii::app()->user->hasFlash('Success')): ?>

	<div class="alert alert-success">
		<?php echo Yii::app()->user->getFlash('Success'); ?>
	</div>

	<?php endif; ?>
	
	<?php if(Yii::app()->user->hasFlash('Error')): ?>
	 
	<div class="alert alert-error">
		<?php echo Yii::app()->user->getFlash('Error'); ?>
	</div>
	 
	<?php endif; ?>
	
<!-- Search Form -->
<?php 
	$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
		'id'=>'searchCustomerForm',
		'type'=>'horizontal',
        'enableAjaxValidation'=>false,
        'enableClientValidation'=>true,
        'clientOptions'=>array(
                'validateOnSubmit'=>true,
        ),
		'htmlOptions'=>array('class'=>'well'),
		)); 
?>
	<fieldset>
		<legend>
			Pencarian Detail Penjualan
		</legend>
<?php
	echo $form->textFieldRow($penjualan, 'kd_penjualan',
		array('class'=>'input-medium', 'prepend'=>'<i class="icon-search"></i>', 'value'=>""));
?>
 
<?php 
	echo $form->datepickerRow($penjualan, 'date',
        array('prepend'=>'<i class="icon-calendar"></i>', 'dateFormat'=>'dd-mm-yy', 'value'=>"")
	); 
?>
	
	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Go',
		)); ?>
	</div>
	</fieldset>
<?php $this->endWidget(); ?>

<?php

$gridDataProvider = new CArrayDataProvider($detailPenjualan);
 
// $gridColumns
$gridColumns = array(
	array(
	  'header'=>'No.',
		'htmlOptions' => array('style'=>'width:40px;'),
	  'value'=>'$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
	),
	array(
		'name'=>'product', 
		'header'=>'Produk',
	),
	//array('name'=>'jumlah', 'header'=>'Jumlah'),
	array(
		'name'=>'date',
		'header'=>'Tanggal'
	),
	array(
		'name'=>'invoice',
		'header'=>'Nomor Invoice',
	),
	array(
		'name'=>'customer',
		'header'=>'Customer'
	),
	//array('name'=>'total_harga', 'header'=>'Total'),
	array(
		'htmlOptions' => array('nowrap'=>'nowrap'),
		'class'=>'bootstrap.widgets.TbButtonColumn',
                
        'template'=>"{update}{delete}",
		'viewButtonUrl'=>'Yii::app()->createUrl("detailPenjualan/view/".$data["id"])',
		'updateButtonUrl'=>'Yii::app()->createUrl("logKendaraan/update/".$data["log_kendaraan_id"])',
		'deleteButtonUrl'=>'Yii::app()->createUrl("detailPenjualan/delete/".$data["id"])',
	)
);

$this->widget('bootstrap.widgets.TbGridView', array(
        'type'=>"striped bordered",
	'dataProvider'=>$gridDataProvider,
	//'template'=>"{items}",
	'columns'=>$gridColumns,
        'enablePagination'=>true
));

?>