<?php
$this->breadcrumbs=array(
	'Kendaraans'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Kendaraan','url'=>array('admin')),
	array('label'=>'Create Kendaraan','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('kendaraan-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Kendaraan</h1>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'kendaraan-grid',
        'type'=>'striped bordered',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
                array(
                  'header'=>'No.',
                  'value'=>'$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
                ),
                array(
                    'filter'=>  CHtml::listData(MerkKendaraan::model()->findAll(), 'id', 'name'),
                    'header'=>'Merk',
                    'name'=>'merk_kendaraan_id',
                    'value'=>'$data->merkKendaraan->name'
                ),
                array(
                    'filter'=>  CHtml::listData(JenisKendaraan::model()->findAll(), 'id', 'name'),
                    'header'=>'Jenis',
                    'name'=>'jenis_kendaraan_id',
                    'value'=>'$data->jenisKendaraan->name'
                ),
                /*
                array(
                    'filter'=>  CHtml::listData(KategoriKendaraan::model()->findAll(), id, name),
                    'header'=>'Kategori',
                    'name'=>'kategori_kendaraan_id',
                    'value'=>'$data->kategoriKendaraan->name'
                ),
                
                array(
                    'filter'=>  CHtml::listData(BahanBakar::model()->findAll(), id, name),
                    'header'=>'Bahan Bakar',
                    'name'=>'bahan_bakar_id',
                    'value'=>'$data->bahanBakar->name'
                ),
                */
		//'jenis_kendaraan_id',
		//'kategori_kendaraan_id',
		//'bahan_bakar_id',
		'no_kendaraan',
		
		'no_mesin',
		
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
