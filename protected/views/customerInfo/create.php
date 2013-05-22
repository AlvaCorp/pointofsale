<?php
$this->breadcrumbs=array(
	'Customer Infos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List CustomerInfo','url'=>array('index')),
	array('label'=>'Manage CustomerInfo','url'=>array('admin')),
);
?>

<h1>Create CustomerInfo</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>