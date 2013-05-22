<?php
$this->breadcrumbs=array(
	'Detail Kendaraans'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List DetailKendaraan','url'=>array('index')),
	array('label'=>'Manage DetailKendaraan','url'=>array('admin')),
);
?>

<h1>Create DetailKendaraan</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>