<?php
$this->breadcrumbs=array(
	'Customer Infos'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List CustomerInfo','url'=>array('index')),
	array('label'=>'Create CustomerInfo','url'=>array('create')),
	array('label'=>'View CustomerInfo','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage CustomerInfo','url'=>array('admin')),
);
?>

<h1>Update CustomerInfo <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>