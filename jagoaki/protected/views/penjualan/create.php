<?php
$this->breadcrumbs=array(
	'Penjualans'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Penjualan','url'=>array('index')),
	array('label'=>'Manage Penjualan','url'=>array('admin')),
);
?>

<h1>Transaksi Penjualan</h1>

<?php echo $this->renderPartial('_form', 
        array(
            'kendaraan' => $kendaraan,
            'detailKendaraan'=>$detailKendaraan,
            'customer'=>$customer,
            'logKendaraan'=>$logKendaraan,
            'penjualan'=>$penjualan,
            'detailPenjualan'=>$detailPenjualan
        )
 ); 
?>