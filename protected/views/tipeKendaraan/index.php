<?php
$this->breadcrumbs=array(
	'Tipe Kendaraans',
);

$this->menu=array(
	array('label'=>'Create TipeKendaraan','url'=>array('create')),
	array('label'=>'Manage TipeKendaraan','url'=>array('admin')),
);
?>

<h1>Tipe Kendaraans</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
