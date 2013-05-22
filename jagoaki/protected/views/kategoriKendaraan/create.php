<?php
$this->breadcrumbs=array(
	'Kategori Kendaraans'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List KategoriKendaraan','url'=>array('index')),
	array('label'=>'Manage KategoriKendaraan','url'=>array('admin')),
);
?>

<h1>Create KategoriKendaraan</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>