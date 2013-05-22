<?php
$this->breadcrumbs=array(
	'Customer Categories'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List','url'=>array('index')),
	array('label'=>'Manage','url'=>array('admin')),
);
?>

<h1>Create Customer Category</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>