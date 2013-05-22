<?php
$this->breadcrumbs=array(
	'Log Kendaraans'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List LogKendaraan','url'=>array('index')),
	array('label'=>'Create LogKendaraan','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('log-kendaraan-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Log Kendaraans</h1>

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
	'id'=>'log-kendaraan-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'modifikasi_id',
		'masalah_id',
		'beban_id',
		'teknisi_id',
		'detail_kendaraan_id',
		/*
		'kondisi_id',
		'date',
		*/
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
