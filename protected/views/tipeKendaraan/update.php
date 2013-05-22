<?php
$this->breadcrumbs=array(
	'Tipe Kendaraans'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List TipeKendaraan','url'=>array('index')),
	array('label'=>'Create TipeKendaraan','url'=>array('create')),
	array('label'=>'View TipeKendaraan','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage TipeKendaraan','url'=>array('admin')),
);
?>

<h1>Update TipeKendaraan <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>