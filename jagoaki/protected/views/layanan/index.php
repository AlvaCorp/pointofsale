<?php
$this->breadcrumbs=array(
	'Perawatans',
);

$this->menu=array(
	array('label'=>'Create Perawatan','url'=>array('create')),
	array('label'=>'Manage Perawatan','url'=>array('admin')),
);
?>

<h1>Perawatans</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
