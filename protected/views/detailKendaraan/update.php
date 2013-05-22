<?php
$this->breadcrumbs=array(
	'Detail Kendaraans'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List DetailKendaraan','url'=>array('index')),
	array('label'=>'Create DetailKendaraan','url'=>array('create')),
	array('label'=>'View DetailKendaraan','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage DetailKendaraan','url'=>array('admin')),
);
?>

<h1>Update DetailKendaraan <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>