<?php
$this->breadcrumbs=array(
	'Bahan Bakar'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List BahanBakar','url'=>array('admin')),
	array('label'=>'Create BahanBakar','url'=>array('create')),
	array('label'=>'View BahanBakar','url'=>array('view','id'=>$model->id)),
	//array('label'=>'Manage BahanBakar','url'=>array('admin')),
);
?>

<h1>Update BahanBakar <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>