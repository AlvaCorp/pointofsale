<?php
$this->breadcrumbs=array(
	'Customer Categories'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List','url'=>array('index')),
	array('label'=>'Create','url'=>array('create')),
	array('label'=>'Update','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage','url'=>array('admin')),
);
?>

<h1>View Customer Category #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
	),
)); ?>
