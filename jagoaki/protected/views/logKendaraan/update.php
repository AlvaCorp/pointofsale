<?php
$this->breadcrumbs=array(
	'Log Kendaraans'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List LogKendaraan','url'=>array('index')),
	array('label'=>'Create LogKendaraan','url'=>array('create')),
	array('label'=>'View LogKendaraan','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage LogKendaraan','url'=>array('admin')),
);
?>

<h1>Update Log Kendaraan <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model, 'Kendaraan'=>$Kendaraan, 'detailPenjualan'=>$detailPenjualan, 'DetailKendaraan'=>$DetailKendaraan, 'Customer'=>$Customer)); ?>