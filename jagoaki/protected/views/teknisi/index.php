<?php
$this->breadcrumbs=array(
	'Teknisis',
);

$this->menu=array(
	array('label'=>'Create Teknisi','url'=>array('create')),
	array('label'=>'Manage Teknisi','url'=>array('admin')),
);
?>

<h1>Teknisis</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
