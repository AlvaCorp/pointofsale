<?php
$this->breadcrumbs=array(
	'Kategori Kendaraans'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List KategoriKendaraan','url'=>array('index')),
	array('label'=>'Create KategoriKendaraan','url'=>array('create')),
	array('label'=>'View KategoriKendaraan','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage KategoriKendaraan','url'=>array('admin')),
);
?>

<h1>Update KategoriKendaraan <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>