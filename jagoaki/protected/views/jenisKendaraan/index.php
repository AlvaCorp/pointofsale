<?php
$this->breadcrumbs=array(
	'Jenis Kendaraans',
);

$this->menu=array(
	array('label'=>'Create JenisKendaraan','url'=>array('create')),
	array('label'=>'Manage JenisKendaraan','url'=>array('admin')),
);
?>

<h1>Jenis Kendaraans</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
