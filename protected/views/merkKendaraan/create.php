<?php
$this->breadcrumbs=array(
	'Merk Kendaraans'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List MerkKendaraan','url'=>array('index')),
	array('label'=>'Manage MerkKendaraan','url'=>array('admin')),
);
?>

<h1>Create MerkKendaraan</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>