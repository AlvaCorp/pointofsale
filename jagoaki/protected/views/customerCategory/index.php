<?php
$this->breadcrumbs=array(
	'Customer Categories',
);

$this->menu=array(
	array('label'=>'Create','url'=>array('create')),
	array('label'=>'Manage','url'=>array('admin')),
);
?>

<h1>Customer Categories</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
