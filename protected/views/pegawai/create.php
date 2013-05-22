<?php
$this->breadcrumbs=array(
	'Teknisis'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Pegawai','url'=>array('index')),
	array('label'=>'Manage Pegawai','url'=>array('admin')),
);
?>

<h1>Add New Pegawai</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>