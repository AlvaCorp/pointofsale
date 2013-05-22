<?php
$this->breadcrumbs=array(
	'Kategori Kendaraans'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List KategoriKendaraan','url'=>array('index')),
	array('label'=>'Create KategoriKendaraan','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('kategori-kendaraan-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Kategori Kendaraan</h1>


<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'kategori-kendaraan-grid',
        'type'=>'striped bordered',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
                array(
                  'header'=>'No.',
                  'value'=>'$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
                ),
		'kd_penggunaan',
		'name',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
