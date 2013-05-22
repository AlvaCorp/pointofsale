<?php
$this->breadcrumbs=array(
	'Penjualan'=>array('index'),
	'New Customer',
);

$this->menu=array(
	array('label'=>'List Customer','url'=>array('index')),
	array('label'=>'Manage Customer','url'=>array('admin')),
);
?>

<h1>Add New Customer</h1>

<?php echo $this->renderPartial('_formNewCustomer', array('model'=>$model, 'no'=>$no)); ?>
