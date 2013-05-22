<?php
$this->breadcrumbs=array(
	'Penjualans'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Penjualan','url'=>array('index')),
	array('label'=>'Create Penjualan','url'=>array('create')),
	array('label'=>'Update Penjualan','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Penjualan','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Penjualan','url'=>array('admin')),
);
?>

<h1>View Penjualan #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
        'type'=>'bordered',
	'attributes'=>array(
		//'id',
		//'penjualan_id',
		//'user_role_id',
		//'log_kendaraan_id',
		array(
			'label' => 'Customer',
			'name' => 'customer.name',
		),
		'kd_penjualan',
		'date',
		'total',
		//'bayar',
	),
)); ?>

<form class="form-horizontal">
	<?php $this->widget('bootstrap.widgets.TbButton',array(
			'label' => 'Lihat Invoice',
			'type'  => 'info',
			'url'  => Yii::app()->createUrl('penjualan/cetak/', array('id'=>$model->id, 'code'=>$model->code, 'cust'=>$model->customer_id)),
			'icon'=>'icon-zoom-in'
	));?>
</form>

<h1>Daftar Invoice Aki Siap Cetak Garansi</h1>

<?php

$gridDataProvider = new CArrayDataProvider($detailPenjualan);
 
// $gridColumns
$gridColumns = array(
	array(
	  'header'=>'No.',
		'htmlOptions' => array('style'=>'width:40px;'),
	  'value'=>'$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
	),
	array(
		'name'=>'merk', 
		'header'=>'Merk',
	),
        array(
                'name'=>'tipe',
                'header'=>'Tipe'
        ),
	//array('name'=>'jumlah', 'header'=>'Jumlah'),
	array(
		'name'=>'tanggal',
		'header'=>'Tanggal'
	),
	array(
		'name'=>'invoice',
		'header'=>'Nomor Invoice',
	),
	array(
		'name'=>'customer',
		'header'=>'Customer'
	),
	//array('name'=>'total_harga', 'header'=>'Total'),
	array(
            'htmlOptions' => array('nowrap'=>'nowrap'),
            'class'=>'bootstrap.widgets.TbButtonColumn',

            'template'=>"{view}",
                    'viewButtonUrl'=>'Yii::app()->createUrl("logKendaraan/garansi/".$data["log_kendaraan"])',
                    'updateButtonUrl'=>'Yii::app()->createUrl("logKendaraan/update/".$data["logKendaraan"]["id"])',
                    'deleteButtonUrl'=>'Yii::app()->createUrl("detailPenjualan/delete/".$data["id"])',
            'buttons'=>array(
                'view'=>array(
                    'options'=>array(
                        'target'=>'_blank'
                    )
                )
            )
            
         
	)
);

$this->widget('bootstrap.widgets.TbGridView', array(
        'type'=>"striped bordered",
	'dataProvider'=>$gridDataProvider,
	//'template'=>"{items}",
	'columns'=>$gridColumns,
));
?>

<SCRIPT type="text/javascript">
    /*
    noBack();
    window.history.forward();
    function noBack() { window.history.forward(); }
    */
</SCRIPT>
