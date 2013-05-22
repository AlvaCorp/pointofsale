<?php
$this->breadcrumbs=array(
	'Teknisis'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Teknisi','url'=>array('index')),
	array('label'=>'Create Teknisi','url'=>array('create')),
	array('label'=>'Update Teknisi','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Teknisi','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Teknisi','url'=>array('admin')),
);
?>

<h1>View Teknisi #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
        'type'=>'bordered',
	'attributes'=>array(
		//'id',
		array(
                    'name'=>'user.name',
                    'label'=>'User'
                ),
		array(
                    'name'=>'propinsi.name',
                    'label'=>'Propinsi'
                ),
		array(
                    'name'=>'kota.name',
                    'label'=>'Kota',
                ),
		'name',
		'alamat',
		'email',
		'phone',
		'mobile_phone',
		'status',
	),
)); ?>
