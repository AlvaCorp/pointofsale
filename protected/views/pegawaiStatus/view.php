<?php
$this->breadcrumbs=array(
	'Pegawai Statuses'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List PegawaiStatus','url'=>array('index')),
	array('label'=>'Create PegawaiStatus','url'=>array('create')),
	array('label'=>'Update PegawaiStatus','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete PegawaiStatus','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage PegawaiStatus','url'=>array('admin')),
);
?>

<h1>View PegawaiStatus #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
	),
)); ?>
