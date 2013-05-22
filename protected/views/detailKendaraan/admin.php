<?php
$this->breadcrumbs=array(
	'Detail Kendaraans'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List DetailKendaraan','url'=>array('index')),
	array('label'=>'Create DetailKendaraan','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('detail-kendaraan-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Detail Kendaraans</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'detail-kendaraan-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
                array(
                  'header'=>'No.',
                  'value'=>'$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
                ),
                array(
                    //'filter'=>  CHtml::listData(User::model()->findAll(), 'id', 'name'),
                    'header'=>'Nomor Mesin Kendaraan',
                    'name'=>'kendaraan_id',
                    'value'=>'$data->kendaraan->no_mesin',
                ),
                array(
                    //'filter'=>  CHtml::listData(User::model()->findAll(), 'id', 'name'),
                    'header'=>'Customer',
                    'name'=>'customer_id',
                    'value'=>'$data->customer->name',
                ),
		'nopol',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
