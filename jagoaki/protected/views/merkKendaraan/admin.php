<?php
$this->breadcrumbs=array(
	'Merk Kendaraans'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List MerkKendaraan','url'=>array('index')),
	array('label'=>'Create MerkKendaraan','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('merk-kendaraan-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Merk Kendaraans</h1>


<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'merk-kendaraan-grid',
        'type'=>'striped bordered',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
                array(
                  'header'=>'No.',
                  'value'=>'$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
                ),
		'kd_merk',
		'name',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
