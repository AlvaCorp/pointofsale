<?php
$this->breadcrumbs=array(
	'Kendaraan'=>array('admin'),
	'Bahan Bakar',
);

$this->menu=array(
	array('label'=>'List BahanBakar','url'=>array('admin')),
	array('label'=>'Create BahanBakar','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('bahan-bakar-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Bahan Bakar</h1>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'bahan-bakar-grid',
        'type'=>'striped bordered',
        'template'=>"{items}",
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
                array(
                  'header'=>'No.',
                  'value'=>'$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
                ),
		'name',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
