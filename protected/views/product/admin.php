<?php
$this->breadcrumbs=array(
	'Products'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Product','url'=>array('index')),
	array('label'=>'Create Product','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('product-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Products</h1>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'product-grid',
        'type'=>'striped bordered',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
                array(
                  'header'=>'No.',
                  'value'=>'$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
                ),
            
                'kd_product',
                
		//'gerai_id',
                array(
                    'filter'=>  CHtml::listData(ProductCategory::model()->findAll(), 'id', 'name'),
                    'header'=>'Kategori Produk',
                    'name'=>'product_category_id',
                    'value'=>'$data->productCategory->name',
                ),
		//'product_category_id',
                /*
                array(
                    'filter'=>  CHtml::listData(MerkProduct::model()->findAll(), 'id', 'name'),
                    'header'=>'Merk',
                    'name'=>'merk_product_id',
                    'value'=>'$data->merkProduct->name'
                ),
            
                array(
                    'filter'=>  CHtml::listData(ProductType::model()->findAll(), 'id', 'name'),
                    'header'=>'Tipe',
                    'name'=>'product_type_id',
                    'value'=>'$data->productType->name'
                ),
                */
		//'merk_product_id',
		
		'harga',
		/*
		'tanggal_produksi',
		'no_produksi',
		'harga',
		'diskon',
		'jumlah',
		'kendaraan',
		'garansi_max',
		*/
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
