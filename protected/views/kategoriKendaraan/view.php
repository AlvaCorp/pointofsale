<?php
$this->breadcrumbs=array(
	'Kategori Kendaraan'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List KategoriKendaraan','url'=>array('index')),
	array('label'=>'Create KategoriKendaraan','url'=>array('create')),
	array('label'=>'Update KategoriKendaraan','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete KategoriKendaraan','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage KategoriKendaraan','url'=>array('admin')),
);
?>

<h1>View Kategori Kendaraan #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
        'type'=>'bordered',
	'attributes'=>array(
		//'id',
		'kd_penggunaan',
		'name',
	),
)); ?>
