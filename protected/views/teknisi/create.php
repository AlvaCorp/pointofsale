<?php
$this->breadcrumbs=array(
	'Teknisis'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Teknisi','url'=>array('index')),
	array('label'=>'Manage Teknisi','url'=>array('admin')),
);
?>

<h1>Create Teknisi</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>