<?php
$this->breadcrumbs=array(
	'Customers'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Customer','url'=>array('index')),
	array('label'=>'Create Customer','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('customer-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Customers</h1>

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
	'id'=>'customer-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
                array(
                  'header'=>'No.',
                  'value'=>'$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
                ),
		'no_ktp',
		'no_sim',
                'name',
                /*
		'customer_info_id',
		'customer_category_id',
                */
                array(
                    'filter'=>CHtml::listData(Propinsi::model()->findAll(array('condition'=>"negara_id='114'")), 'id', 'name'),
                    'header'=>'Propinsi',
                    'name'=>'propinsi_id',
                    'value'=>'$data->propinsi->name'
                ),
                array(
                    'filter'=>CHtml::listData(Kota::model()->findAll(array('with'=>'propinsi', 'condition'=>"propinsi.negara_id='114'")), 'id', 'name'),
                    'header'=>'Kota',
                    'name'=>'kota_id',
                    'value'=>'$data->kota->name'
                ),
		/*
		'email',
		'phone',
		'mobile_phone',
                 */

                /*
		'alamat',
		'status',
		*/
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
