<?php
$this->breadcrumbs=array(
	'Detail Kendaraans',
);

$this->menu=array(
	array('label'=>'Create DetailKendaraan','url'=>array('create')),
	array('label'=>'Manage DetailKendaraan','url'=>array('admin')),
);
?>

<h1>Detail Kendaraans</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
