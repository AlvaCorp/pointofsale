<?php
$this->breadcrumbs=array(
	'Pegawai Statuses'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List PegawaiStatus','url'=>array('index')),
	array('label'=>'Create PegawaiStatus','url'=>array('create')),
	array('label'=>'View PegawaiStatus','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage PegawaiStatus','url'=>array('admin')),
);
?>

<h1>Update PegawaiStatus <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>