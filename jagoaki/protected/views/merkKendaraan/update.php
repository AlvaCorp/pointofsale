<?php
$this->breadcrumbs=array(
	'Merk Kendaraans'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List MerkKendaraan','url'=>array('index')),
	array('label'=>'Create MerkKendaraan','url'=>array('create')),
	array('label'=>'View MerkKendaraan','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage MerkKendaraan','url'=>array('admin')),
);
?>

<h1>Update MerkKendaraan <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>