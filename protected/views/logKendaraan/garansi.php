<style>
.garansi{
	font-size:20px;
	letter-spacing: 2px;
	line-height: 20px;
}
.v{
    border-left:1px solid #000;
    border-right:1px solid #000;
}

.h{
    border-top:1px solid #000;
    border-bottom:1px solid #000;
}
</style>

<div style="float:right;">
    <h3>
    <?php echo $kodeGaransi; ?>
    </h3>
</div>
<br /><br /><br /><br />
<table class="garansi">
	<tr>
		<td>
		TIPE AKI
		</td>
		<td>
			<?php echo $detailPenjualan->product->name; ?>
		</td>
	</tr>
	<tr>
		<td>
		MERK AKI
		</td>
		<td>
			<?php echo $detailPenjualan->product->merkProduct->name; ?>
		</td>
	</tr>
	<tr>
		<td>
		TANGGAL PRODUKSI
		</td>
		<td>
			<?php echo $detailPenjualan->tanggal_produksi; ?>
		</td>
	</tr>
	<tr>
		<td>
		KODE/NO. PRODUKSI
		</td>
		<td>
			<?php echo $detailPenjualan->kode_produksi; ?>
		</td>
	</tr>
	<tr>
		<td>
		PERIODE GARANSI
		</td>
		<td>
			<?php echo $periode_mulai; ?>
			&nbsp;
			s/d
			&nbsp;
			<?php echo $periode_selesai; ?>
			&nbsp;
			<?php
				echo $garansi;
			?>
			bulan
		</td>
	</tr>
	<tr>
		<td>
		</td>
		<td>
		</td>
	</tr>
	<tr>
		<td>
		</td>
		<td>
		</td>
	</tr>
	<tr>
		<td>
		JENIS KENDARAAN
		</td>
		<td>
			<?php echo $kendaraan->jenisKendaraan->name; ?>
		</td>
	</tr>
	<tr>
		<td>
		MERK KENDARAAN
		</td>
		<td>
			<?php echo $kendaraan->merkKendaraan->name; ?>......
			No. Polisi : <?php echo $detailKendaraan->nopol; ?>
		</td>
	</tr>
	<tr>
		<td>
		NAMA LENGKAP
		</td>
		<td>
			<?php echo $customer->name; ?>
		</td>
	</tr>
	<tr>
		<td>
		ALAMAT LENGKAP
		</td>
		<td>
			<?php echo $customer->alamat; ?>
		</td>
	</tr>
	<tr>
		<td>
		NO. TELP PEMILIK
		</td>
		<td>
			RUMAH : <?php echo $customer->phone; ?>
			&nbsp;&nbsp;&nbsp;&nbsp;
			HP : <?php echo $customer->mobile_phone; ?>
		</td>
	</tr>
</table>
<?php
    /*
	$kartuGaransi = new KartuGaransi;
	$kartuGaransi->detail_kendaraan_id = $model->detail_kendaraan_id;
	$kartuGaransi->detail_penjualan_id = $detailPenjualan->id;
	$kartuGaransi->product_id = $detailPenjualan->product_id;
	$kartuGaransi->date_create = date('Y-m-d');
	$kartuGaransi->periode_mulai = date('Y-m-d', strtotime($periode_mulai));
	$kartuGaransi->periode_selesai = date('Y-m-d', strtotime($periode_selesai));
        $kartuGaransi->km_awal = LogKendaraan::model()->findByPk($logKendaraan->id)->km_awal;
        if($garansi==3){
            $kartuGaransi->km_akhir = LogKendaraan::model()->findByPk($logKendaraan->id)->km_awal + 5000;
            $logKendaraan->km_akhir = $kartuGaransi->km_akhir;
        }
        if($garansi==6){
            $kartuGaransi->km_akhir = LogKendaraan::model()->findByPk($logKendaraan->id)->km_awal + 10000;
            $logKendaraan->km_akhir = $kartuGaransi->km_akhir;
        }
        if($garansi==9){
            $kartuGaransi->km_akhir = LogKendaraan::model()->findByPk($logKendaraan->id)->km_awal + 15000;
            $logKendaraan->km_akhir = $kartuGaransi->km_akhir;
        }
        if($garansi==12){
            $kartuGaransi->km_akhir = LogKendaraan::model()->findByPk($logKendaraan->id)->km_awal + 20000;
            $logKendaraan->km_akhir = $kartuGaransi->km_akhir;
        }
        if($garansi==16){
            $kartuGaransi->km_akhir = LogKendaraan::model()->findByPk($logKendaraan->id)->km_awal + 25000;
            $logKendaraan->km_akhir = $kartuGaransi->km_akhir;
        }
        if($garansi==20){
            $kartuGaransi->km_akhir = LogKendaraan::model()->findByPk($logKendaraan->id)->km_awal + 30000;
            $logKendaraan->km_akhir = $kartuGaransi->km_akhir;
        }
	$kartuGaransi->status = 1;
	if($kartuGaransi->save() && $logKendaraan->save()){
		$nkartuGaransi = KartuGaransi::model()->findByPk($kartuGaransi->id);
		$nkartuGaransi->kode = str_replace('-', '', substr(date('Y-m-d'), 2, 8) . $kartuGaransi->id);
		$nkartuGaransi->save();
	}
     * 
     */
?>