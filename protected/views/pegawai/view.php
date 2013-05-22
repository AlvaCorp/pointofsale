<?php
$this->breadcrumbs=array(
	'Teknisis'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'Daftar Pegawai','url'=>array('index')),
	array('label'=>'Add New Pegawai','url'=>array('create')),
	array('label'=>'Update Pegawai','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Pegawai','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Pegawai','url'=>array('admin')),
);
?>

<h1>View Pegawai #<?php echo $model->user->name; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
        'type'=>'bordered',
	'attributes'=>array(
		//'id',
		array(
                    'name'=>'user.name',
                    'label'=>'Name'
                ),
		array(
                    'name'=>'propinsi.name',
                    'label'=>'Propinsi'
                ),
		array(
                    'name'=>'kota.name',
                    'label'=>'Kota',
                ),
		//'name',
		'alamat',
		'email',
		'phone',
		'mobile_phone',
		array(
                    'name'=>'status0.name',
                    'label'=>'Status Pegawai'
                ),
	),
)); ?>
