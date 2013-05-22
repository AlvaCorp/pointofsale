<?php
$this->breadcrumbs=array(
	'Pegawai Statuses',
);

$this->menu=array(
	array('label'=>'Create PegawaiStatus','url'=>array('create')),
	array('label'=>'Manage PegawaiStatus','url'=>array('admin')),
);
?>

<h1>Pegawai Statuses</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
