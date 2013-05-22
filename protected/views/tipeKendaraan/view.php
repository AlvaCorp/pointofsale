<?php
$this->breadcrumbs=array(
	'Tipe Kendaraans'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List TipeKendaraan','url'=>array('index')),
	array('label'=>'Create TipeKendaraan','url'=>array('create')),
	array('label'=>'Update TipeKendaraan','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete TipeKendaraan','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TipeKendaraan','url'=>array('admin')),
);
?>

<h1>View TipeKendaraan #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		//'id',
		'merk_kendaraan_id',
		'kd_tipe_kendaraan',
		'name',
		'date_create',
	),
)); ?>
