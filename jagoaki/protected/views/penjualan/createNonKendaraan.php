<?php
$this->breadcrumbs=array(
	'Penjualan'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Penjualan','url'=>array('index')),
	array('label'=>'Manage Penjualan','url'=>array('admin')),
);
?>

<h1>Transaksi Penjualan Non Kendaraan</h1>

<?php echo $this->renderPartial('_formNonKendaraan', 
        array(
            'customer'=>$customer,
            'penjualan'=>$penjualan,
            'detailPenjualan'=>$detailPenjualan
        )
 ); 
?>
