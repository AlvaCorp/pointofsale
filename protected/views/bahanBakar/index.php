<?php
$this->breadcrumbs=array(
	'Bahan Bakars',
);

$this->menu=array(
	array('label'=>'Create BahanBakar','url'=>array('create')),
	array('label'=>'Manage BahanBakar','url'=>array('admin')),
);
?>

<h1>Bahan Bakars</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
