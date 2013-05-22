<?php
$this->breadcrumbs=array(
	'Pegawais'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Pegawai','url'=>array('index')),
	array('label'=>'Create Pegawai','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('pegawai-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Pegawais</h1>

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
	'id'=>'pegawai-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
                array(
                  'header'=>'No.',
                  'value'=>'$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
                ),
                array(
                    //'filter'=>  CHtml::listData(User::model()->findAll(), 'id', 'name'),
                    'header'=>'User',
                    'name'=>'user_id',
                    'value'=>'$data->user->name',
                ),
                array(
                    'filter'=>  CHtml::listData(Propinsi::model()->findAll(), 'id', 'name'),
                    'header'=>'Propinsi',
                    'name'=>'propinsi_id',
                    'value'=>'$data->propinsi->name',
                ),
                array(
                    //'filter'=>  CHtml::listData(User::model()->findAll(), 'id', 'name'),
                    'header'=>'Kota',
                    'name'=>'kota_id',
                    'value'=>'$data->kota->name',
                ),
                array(
                    'filter'=>  CHtml::listData(Jabatan::model()->findAll(), 'id', 'name'),
                    'header'=>'Jabatan',
                    'name'=>'jabatan_id',
                    'value'=>'$data->jabatan->name',
                ),
		//'name',
		/*
		'alamat',
		'email',
		'phone',
		'mobile_phone',
		'status',
		*/
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
