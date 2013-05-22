<?php
$this->breadcrumbs=array(
	'Bahan Bakar'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List BahanBakar','url'=>array('admin')),
	//array('label'=>'Manage BahanBakar','url'=>array('admin')),
);
?>

<h1>Create BahanBakar</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>