<?php
$this->breadcrumbs=array(
	'Customer Categories'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List','url'=>array('index')),
	array('label'=>'Create','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('customer-category-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Customer Categories</h1>


<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'customer-category-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
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
