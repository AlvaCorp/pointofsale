<?php
$this->breadcrumbs=array(
	'Merk Kendaraan'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List MerkKendaraan','url'=>array('index')),
	array('label'=>'Create MerkKendaraan','url'=>array('create')),
	array('label'=>'Update MerkKendaraan','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete MerkKendaraan','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage MerkKendaraan','url'=>array('admin')),
);
?>

<h1>View Merk Kendaraan #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
        'type'=>'bordered',
	'attributes'=>array(
		//'id',
		'kd_merk',
		'name',
	),
)); ?>
