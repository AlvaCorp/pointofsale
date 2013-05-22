<?php
$this->breadcrumbs=array(
	'Penjualans',
);

$this->menu=array(
	array('label'=>'Create Penjualan','url'=>array('create')),
	array('label'=>'Manage Penjualan','url'=>array('admin')),
);
?>

<h1>Penjualan</h1>

<!-- Search Form -->
<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'searchKendaraanForm',
	'type'=>'search',
        'enableAjaxValidation'=>false,
        'enableClientValidation'=>true,
        'clientOptions'=>array(
                'validateOnSubmit'=>true,
        ),
	'htmlOptions'=>array('class'=>'well'),
)); ?>
<?php
        echo "Penjualan Produk Dengan  Kendaraan";
        echo "<br /><br />";
	echo $form->textFieldRow($kendaraan, 'no_mesin',
		array('class'=>'input-medium', 'prepend'=>'<i class="icon-search"></i>'));
?>
<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'label'=>'Go')); ?>
 
<?php $this->endWidget(); ?>
<!-- End Of Search Form -->


<!-- Search Form -->
<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'searchCustomerForm',
	'type'=>'search',
        'enableAjaxValidation'=>false,
        'enableClientValidation'=>true,
        'clientOptions'=>array(
                'validateOnSubmit'=>true,
        ),
	'htmlOptions'=>array('class'=>'well'),
)); ?>
<?php
        echo "Penjualan Produk Tanpa Kendaraan";
        echo "<br /><br />";
	echo $form->textFieldRow($customer, 'no_ktp',
		array('class'=>'input-medium', 'prepend'=>'<i class="icon-search"></i>'));
?>
<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'label'=>'Go')); ?>
 
<?php $this->endWidget(); ?>
<!-- End Of Search Form -->
