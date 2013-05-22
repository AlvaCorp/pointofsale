<?php
$this->breadcrumbs=array(
	'Pegawai Statuses'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List PegawaiStatus','url'=>array('index')),
	array('label'=>'Manage PegawaiStatus','url'=>array('admin')),
);
?>

<h1>Create PegawaiStatus</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>