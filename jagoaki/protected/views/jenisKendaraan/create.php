<?php
$this->breadcrumbs=array(
	'Jenis Kendaraans'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List JenisKendaraan','url'=>array('index')),
	array('label'=>'Manage JenisKendaraan','url'=>array('admin')),
);
?>

<h1>Create JenisKendaraan</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>