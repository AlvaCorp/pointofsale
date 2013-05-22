<?php
$this->breadcrumbs=array(
	'Merk Kendaraans',
);

$this->menu=array(
	array('label'=>'Create MerkKendaraan','url'=>array('create')),
	array('label'=>'Manage MerkKendaraan','url'=>array('admin')),
);
?>

<h1>Merk Kendaraans</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
