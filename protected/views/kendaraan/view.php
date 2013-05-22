<?php
$this->breadcrumbs=array(
	'Kendaraans'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Kendaraan','url'=>array('index')),
	array('label'=>'Create Kendaraan','url'=>array('create')),
	array('label'=>'Update Kendaraan','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Kendaraan','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Kendaraan','url'=>array('admin')),
);
?>

<h1>View Kendaraan #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
        'type'=>'bordered',
	'attributes'=>array(
		//'id',
                array(
                    'label'=>'Merk',
                    'name'=>'merkKendaraan.name',
                ),
                array(
                    'label'=>'Jenis',
                    'name'=>'jenisKendaraan.name',
                ),
                array(
                    'label'=>'Kategori',
                    'name'=>'kategoriKendaraan.name',
                ),
                array(
                    'label'=>'Bahan Bakar',
                    'name'=>'bahanBakar.name',
                ),
		'no_kendaraan',
		'no_mesin',
	),
)); ?>
