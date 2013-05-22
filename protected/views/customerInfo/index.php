<?php
$this->breadcrumbs=array(
	'Customer Infos',
);

$this->menu=array(
	array('label'=>'Create CustomerInfo','url'=>array('create')),
	array('label'=>'Manage CustomerInfo','url'=>array('admin')),
);
?>

<h1>Customer Infos</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
