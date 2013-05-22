<?php
$this->breadcrumbs=array(
	'Kategori Kendaraans',
);

$this->menu=array(
	array('label'=>'Create KategoriKendaraan','url'=>array('create')),
	array('label'=>'Manage KategoriKendaraan','url'=>array('admin')),
);
?>

<h1>Kategori Kendaraans</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
