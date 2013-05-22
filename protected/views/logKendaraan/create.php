<?php
$this->breadcrumbs=array(
	'Log Kendaraans'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List LogKendaraan','url'=>array('index')),
	array('label'=>'Manage LogKendaraan','url'=>array('admin')),
);
?>

<h1>Create LogKendaraan</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>