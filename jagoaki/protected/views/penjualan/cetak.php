<?php
    Yii::import('application.extensions.MPDF56.*');
    include("mpdf.php");
    ini_set('memory_limit', '256M');
?>
<?php
  $baseUrl = Yii::app()->theme->baseUrl; 
  $cs = Yii::app()->getClientScript();
  Yii::app()->clientScript->registerCoreScript('jquery');
?>

<?php


$html = '
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Sani Iman Pribadi">
    <link rel="stylesheet" type="text/css" href="' . $baseUrl . '/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="' . $baseUrl . '/css/bootstrap-responsive.min.css"> 
    <link rel="stylesheet" type="text/css" href="' . $baseUrl . '/css/template.css">   
    <link rel="stylesheet" type="text/css" href="' . $baseUrl . '/css/style1.css" />
       
		<header>
			<h1>INVOICE</h1>
                        <table class="table">
                            <tr>
                                <td>
                                    <address>
                                            <p>Jl. Raya Surabaya-Mojokerto KM 33, Bypass Krian</p>
                                            <p>Sidoarjo, Jawa Timur (61263)</p>
                                            <p>P: 031-8982388, F: 031-7889944, E: heri@jagoaki.com</p>
                                            <br /><br />
                                            <p><span>NOMOR : <strong>'.Penjualan::model()->find(array('condition'=>"code='$code'"))->kd_penjualan.'</strong></span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>TANGGAL : <strong>'.date('d-m-Y', strtotime(Penjualan::model()->find(array('condition'=>"code='$code'"))->date)).'</strong></span></p>
                                    </address>
                                </td>
                                <td align="right">
                                    <img alt="" src="'.$baseUrl.'/img/ja/128x128.png" />
                                </td>
                            </tr>
                        </table>
                        <table class="table">
                            <tr>
                                <td>
                                    <address>
                                            <p><b><i>Pembeli</i></b></p>
                                            <p>NAMA &nbsp;&nbsp;&nbsp;&nbsp;: <span>'.Customer::model()->find(array('condition'=>'no_ktp='.Penjualan::model()->find(array('condition'=>"code='$code'"))->customer_id))->name.'</span></p>
                                            <p>ALAMAT : <span>'.Customer::model()->find(array('condition'=>'no_ktp='.Penjualan::model()->find(array('condition'=>"code='$code'"))->customer_id))->alamat.'</span></p>
                                    </address>
                                </td>
                                <td align="left">
                                    <span>NOMOR POLISI : </span>
                                </td>
                            </tr>
                        </table>
		</header>
                <article>
<table class="table table-bordered">
    <thead>
            <tr>
                <th>No.</th>
                <th>Nama/Jenis Barang</th>
                <th>Jumlah</th>
                <th>Harga Satuan</th>
                <th>Jumlah Bruto</th>
                <th>%</th>
                <th>Diskon</th>
                <th>Jumlah</th>
            </tr>
            </thead>
            ';
    
    $i = 1;
    foreach($model as $data){
        $html .= '<tr>';

        $html .= '<td>'.$i.'</td>';
        $html .= '<td>'.Product::model()->findByPk($data['product_id'])->name.'</td>';
        $html .= '<td>'.$data['jumlah'].' '.ProductSatuan::model()->findByPk(Product::model()->findByPk($data['product_id']))->name.'</td>';
        
        
        $html .= '<td align="right"> Rp. '.Product::model()->findByPk($data['product_id'])->harga.'</td>';
        $html .= '<td align="right"> Rp. '.$data['total_harga'].'</td>';
        $html .= '<td>'.Product::model()->findByPk($data['product_id'])->diskon.'</td>';
        $html .= '<td align="right"> Rp. '.Product::model()->findByPk($data['product_id'])->diskon*0.01*$data['total_harga'].'</td>';
        
        $total_diskon = $total_diskon + Product::model()->findByPk($data['product_id'])->diskon*0.01*$data['total_harga'];
        $total_bruto = $total_bruto + $data['total_harga'];
        $total_neto = $data['total_harga'] - Product::model()->findByPk($data['product_id'])->diskon*0.01*$data['total_harga'];
        
        $total_harga = $total_harga + $total_neto;
        
        $html .= '<td align="right"> Rp. '.$total_neto.'</td>';
        $html .= '</tr>';
        $i++;
    }
    
    $html .= '<tr>
                <td colspan="4"></td>';
            $html .= '<td align="right"> Rp. '.$total_bruto.'</td>';
            $html .= '<td></td>';
            $html .= '<td align="right"> Rp. '.$total_diskon.'</td>';
            $html .= '<td align="right"> Rp. '.$total_harga.'</td>';
            $html .= '</tr>';
    $html .= '<tr>
                <td colspan="4"></td>';
            $html .= '<td></td>';

            $html .= '<td colspan="2">Pembulatan</td>';
            $sisa = $total_harga % 500;
            $html .= '<td> + Rp. '.$sisa.'</td>';
            $html .= '</tr>';
			
			$penjualan = Penjualan::model()->find(array('condition'=>"code='$code'"));
			
			$penjualan->total_bruto = $total_bruto;
			$penjualan->total_diskon = $total_diskon;
			$penjualan->pembulatan = $sisa;
			$penjualan->total_netto = $total_harga;
			$penjualan->save();
			
            
    $html .= '<tr>
                <td colspan="4"></td>';
            $html .= '<td></td>';
            $html .= '<td colspan="2">T O T A L</td>';
            //$html .= '<td>'.$total_diskon.'</td>';
            $html .= '<td align="right"> Rp. '.$total_harga.'</td>';
            $html .= '</tr>';
    $html .= '</table>';
    $html .= '</article>';
?>

<?php
    $mpdf=new mPDF('utf-8', 'A4'); 

    $mpdf->WriteHTML($html, 'P');
    $mpdf->Output('parkir.pdf', 'I');
    exit;
?>