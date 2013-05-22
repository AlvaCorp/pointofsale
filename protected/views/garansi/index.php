<?php
$this->breadcrumbs=array(
	'Garansi',
);
?>
<h1>Penjualan Produk Bergaransi</h1>
<?php

$gridDataProvider = new CArrayDataProvider(DetailPenjualan::model()->getPenjualanGaransi());
 
// $gridColumns
$gridColumns = array(
	array(
	  'header'=>'No.',
		'htmlOptions' => array('style'=>'width:40px;'),
	  'value'=>'$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
	),
	array(
		'name'=>'invoice', 
		'header'=>'Invoice',
	),
	array(
		'name'=>'product', 
		'header'=>'Produk',
	),
	array(
		'name'=>'customer', 
		'header'=>'Customer',
	),
        array(
                'name'=>'kode',
                'header'=>'Kode Garansi'
        ),
	array(
		'htmlOptions' => array('nowrap'=>'nowrap'),
		'class'=>'bootstrap.widgets.TbButtonColumn',
                
        'template'=>"{update}",
		//'viewButtonUrl'=>'Yii::app()->createUrl("logKendaraan/update/".$data["log_kendaraan_id"])',
		'updateButtonUrl'=>'Yii::app()->createUrl("logKendaraan/update/".$data["log_kendaraan_id"])',
		//'deleteButtonUrl'=>'Yii::app()->createUrl("detailPenjualan/delete/".$data["id"])',
	)
);

$this->widget('bootstrap.widgets.TbGridView', array(
        'type'=>"striped bordered",
	'dataProvider'=>$gridDataProvider,
	//'template'=>"{items}",
	'columns'=>$gridColumns,
));
?>