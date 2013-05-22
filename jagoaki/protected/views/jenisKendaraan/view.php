<?php
$this->breadcrumbs=array(
	'Jenis Kendaraan'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List JenisKendaraan','url'=>array('index')),
	array('label'=>'Create JenisKendaraan','url'=>array('create')),
	array('label'=>'Update JenisKendaraan','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete JenisKendaraan','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage JenisKendaraan','url'=>array('admin')),
);
?>

<h1>View Jenis Kendaraan #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		//'id',
		'name',
		'matrix',
	),
)); ?>
