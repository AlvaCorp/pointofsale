<?php
$this->breadcrumbs=array(
	'Detail Penjualans'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List DetailPenjualan','url'=>array('index')),
	array('label'=>'Create DetailPenjualan','url'=>array('create')),
	array('label'=>'Update DetailPenjualan','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete DetailPenjualan','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage DetailPenjualan','url'=>array('admin')),
);
?>

<h1>View DetailPenjualan #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'penjualan_id',
		'product_id',
		'jumlah',
		'total_harga',
	),
)); ?>
