<?php
$this->breadcrumbs=array(
	'Jenis Kendaraans'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List JenisKendaraan','url'=>array('index')),
	array('label'=>'Create JenisKendaraan','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('jenis-kendaraan-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Jenis Kendaraan</h1>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'jenis-kendaraan-grid',
        'type'=>'striped bordered',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
                array(
                  'header'=>'No.',
                  'value'=>'$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
                ),
		'name',
		'matrix',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
