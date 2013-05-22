<?php
$this->breadcrumbs=array(
	'Log Kendaraans'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List LogKendaraan','url'=>array('index')),
	array('label'=>'Create LogKendaraan','url'=>array('create')),
	array('label'=>'Update LogKendaraan','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete LogKendaraan','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage LogKendaraan','url'=>array('admin')),
);
?>

<h1>View LogKendaraan #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'modifikasi_id',
		'masalah_id',
		'beban_id',
		'teknisi_id',
		'detail_kendaraan_id',
		'kondisi_id',
		'date',
	),
)); ?>
