<?php
$this->breadcrumbs=array(
	'Detail Penjualans',
);

$this->menu=array(
	array('label'=>'Create DetailPenjualan','url'=>array('create')),
	array('label'=>'Manage DetailPenjualan','url'=>array('admin')),
);
?>

<h1>Detail Penjualans</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
