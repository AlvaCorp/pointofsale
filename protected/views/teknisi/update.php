<?php
$this->breadcrumbs=array(
	'Teknisis'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Teknisi','url'=>array('index')),
	array('label'=>'Create Teknisi','url'=>array('create')),
	array('label'=>'View Teknisi','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage Teknisi','url'=>array('admin')),
);
?>

<h1>Update Teknisi <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>