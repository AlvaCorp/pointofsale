<?php
$this->breadcrumbs=array(
	'Perawatans'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Perawatan','url'=>array('index')),
	array('label'=>'Create Perawatan','url'=>array('create')),
	array('label'=>'Update Perawatan','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Perawatan','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Perawatan','url'=>array('admin')),
);
?>

<h1>View Perawatan #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'detail_kendaraan_id',
		'teknisi_id',
		'nomor',
		'km',
		'volt',
		'v_starter',
		'sistem_kelistrikan',
		'load_off',
		'load_on',
		'isi_air_aki',
		'date_create',
		'kartu_garansi_id',
	),
)); ?>
