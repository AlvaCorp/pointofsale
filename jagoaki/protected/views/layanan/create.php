<?php
$this->breadcrumbs=array(
	'Perawatans'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Perawatan','url'=>array('index')),
	array('label'=>'Manage Perawatan','url'=>array('admin')),
);
?>

<h1>Form Servis Aki</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>