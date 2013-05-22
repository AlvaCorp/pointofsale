<?php
$this->breadcrumbs=array(
	'Organisations'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Organisation','url'=>array('index')),
	array('label'=>'Create Organisation','url'=>array('create')),
	array('label'=>'Update Organisation','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Organisation','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Organisation','url'=>array('admin')),
);
?>

<h1>View Organisation #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
        'type'=>'bordered',
	'attributes'=>array(
		//'id',
		array(
                    'name'=>'kota.name',
                    'label'=>'Kota'
                ),
		'name',
		'label',
	),
)); ?>
