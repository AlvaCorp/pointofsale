<?php
$this->breadcrumbs=array(
	'Products'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Product','url'=>array('index')),
	array('label'=>'Create Product','url'=>array('create')),
	array('label'=>'Update Product','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Product','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Product','url'=>array('admin')),
);
?>

<h1>View Product #</h1>

<?php 

$this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
        'type'=>'bordered',
	'attributes'=>array(
		//'id',
		//'gerai_id',
		array(
                    'name'=>'productCategory.name',
                    'label'=>'Kategori Produk',
                ),
		array(
                    'name'=>'merkProduct.name',
                    'lable'=>'Merk Produk'
                ),
		array(
                    'name'=>'productType.name',
                    'lable'=>'Tipe Produk'
                ),
		'kd_product',
		'name',
		//'tanggal_produksi',
		//'no_produksi',
		'harga',
		'diskon',
		//'jumlah',
		//'kendaraan',
		'garansi_max',
	),
)); 

?>

