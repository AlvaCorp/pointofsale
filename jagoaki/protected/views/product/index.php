<?php
$this->breadcrumbs=array(
	'Products',
);

$this->menu=array(
	array('label'=>'Create Product','url'=>array('create')),
	array('label'=>'Manage Product','url'=>array('admin')),
);
?>

<h1>Products</h1>

<?php
$gerai_id = Yii::app()->user->get()->user->gerai_id;
if(Yii::app()->user->get()->role_id==Role::model()->find(array('condition'=>'t.name="pimpinan" or t.name="distributor_admin"'))){
    $gridDataProvider = new CArrayDataProvider(Product::model()->findAll());
}else{
    $gridDataProvider = new CArrayDataProvider(Product::model()->findAll(array('condition'=>"gerai_id='$gerai_id'")));
}
 
// $gridColumns
$gridColumns = array(
	array('name'=>'id', 'header'=>'#', 'htmlOptions'=>array('style'=>'width: 60px')),
	array('name'=>'kd_product', 'header'=>'Kode Product'),
	array('name'=>'name', 'header'=>'Nama'),
	array('name'=>'tanggal_produksi', 'header'=>'Tanggal Produksi'),
	array('name'=>'harga', 'header'=>'Harga'),
	array(
		'htmlOptions' => array('nowrap'=>'nowrap'),
		'class'=>'bootstrap.widgets.TbButtonColumn',
		'viewButtonUrl'=>'Yii::app()->createUrl("product/$data[id]")',
		'updateButtonUrl'=>'Yii::app()->createUrl("product/update/$data[id]")',
		'deleteButtonUrl'=>'Yii::app()->createUrl("product/delete/$data[id]")',
	)
);
?>

<?php
$this->widget('bootstrap.widgets.TbGridView', array(
	'type'=>'striped',
	'dataProvider'=>$gridDataProvider,
	'template'=>"{items}",
	'columns'=>$gridColumns,
));
?>

<?php 
/*
    $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); 
*/    
?>
