<?php
$this->breadcrumbs=array(
	'Kendaraans'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Kendaraan','url'=>array('index')),
	array('label'=>'Manage Kendaraan','url'=>array('admin')),
);
?>

<h1>Create Kendaraan</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>