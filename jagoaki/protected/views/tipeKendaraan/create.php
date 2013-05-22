<?php
$this->breadcrumbs=array(
	'Tipe Kendaraans'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TipeKendaraan','url'=>array('index')),
	array('label'=>'Manage TipeKendaraan','url'=>array('admin')),
);
?>

<h1>Create TipeKendaraan</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>