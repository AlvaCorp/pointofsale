<?php
$this->breadcrumbs=array(
	'Bahan Bakar'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List BahanBakar','url'=>array('admin')),
	array('label'=>'Create BahanBakar','url'=>array('create')),
	array('label'=>'Update BahanBakar','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete BahanBakar','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	//array('label'=>'Manage BahanBakar','url'=>array('admin')),
);
?>

<h1>View Bahan Bakar #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		//'id',
		'name',
	),
)); ?>
