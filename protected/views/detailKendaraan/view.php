<?php
$this->breadcrumbs=array(
	'Detail Kendaraans'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List DetailKendaraan','url'=>array('index')),
	array('label'=>'Create DetailKendaraan','url'=>array('create')),
	array('label'=>'Update DetailKendaraan','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete DetailKendaraan','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage DetailKendaraan','url'=>array('admin')),
);
?>

<h1>View DetailKendaraan #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		//'id',
		array(
                    'label'=>'Kendaraan',
                    'name'=>'kendaraan.no_mesin'
                ),
		array(
                    'label'=>'Customer',
                    'name'=>'customer.name'
                ),
		'nopol',
	),
)); ?>
