<?php
$this->breadcrumbs=array(
	'Teknisis',
);

$this->menu=array(
	array('label'=>'Add New Pegawai','url'=>array('create')),
	array('label'=>'Manage Pegawai','url'=>array('admin')),
);
?>

<h1>Pegawai</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
