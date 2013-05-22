<?php
$this->breadcrumbs=array(
	'Log Kendaraans',
);

$this->menu=array(
	array('label'=>'Create LogKendaraan','url'=>array('create')),
	array('label'=>'Manage LogKendaraan','url'=>array('admin')),
);
?>

<h1>Log Kendaraans</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
