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

<h1>Add New Kendaraan</h1>

<?php echo $this->renderPartial('_formNewKendaraan', array('model'=>$model)); ?>