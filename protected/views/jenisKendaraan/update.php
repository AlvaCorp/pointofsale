<?php
$this->breadcrumbs=array(
	'Jenis Kendaraans'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List JenisKendaraan','url'=>array('index')),
	array('label'=>'Create JenisKendaraan','url'=>array('create')),
	array('label'=>'View JenisKendaraan','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage JenisKendaraan','url'=>array('admin')),
);
?>

<h1>Update JenisKendaraan <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>