<?php //echo "organisation id : " . Yii::app()->user->role()->organisation_id; ?>
<div id="kendaraan" style="display:<?php if(isset($_GET['cust']) && $_GET['cust']!=""){ echo 'none;'; }else{echo 'yes;';} ?>;">
<!-- Search Form -->
<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'searchCustomerForm',
	'type'=>'search',
        'enableAjaxValidation'=>false,
        'enableClientValidation'=>true,
        'clientOptions'=>array(
                'validateOnSubmit'=>true,
        ),
	'htmlOptions'=>array('class'=>'well'),
)); ?>
<?php
        echo "Cari customer berdasarkan nomor KTP";
        echo "<br /><br />";
        
	echo $form->textFieldRow($customer, 'no_ktp',
		array('class'=>'input-medium', 'prepend'=>'<i class="icon-search"></i>', 'value'=>""));
        /*
        echo $form->select2Row($customer, 'no_ktp', array('asDropDownList' => true, 'data' => CHtml::listData(Customer::model()->findAll(), 'no_ktp', 'name'), 'options' => array(
                'placeholder' => 'Pilih Merk Kendaraan',
                'width' => '40%',
                'tokenSeparators' => array(',', ' ')
                )));
        */
?>
<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'success', 'label'=>'Go')); ?>
 <?php if($customer->id===NULL){ ?>
	<span class="alert alert-danger"> Identitas customer tidak ditemukan dalam sistem <i class="icon-question-sign" title="Ketika pesan ini muncul, maka anda akan melakukan input transaksi penjualan dengan menginputkan customer dan kendaraan baru terlebih dahulu"></i></span>
<?php }else if(isset($customer->id) && $customer->id != 1){ ?>
<br /><br />
<?php
$this->menu=array(
	//array('label'=>'Name : ' . $customer->name),
); 
?>
<div class="alert alert-info"> 
<b>Customer</b>
<hr>
<b>Name : </b><?php echo $customer->name; ?>
<br />
<b>Address : </b><?php echo $customer->alamat; ?>
<br />
<b>Identity Number : </b><?php echo $customer->no_ktp; ?>
</div>
<?php } ?>
<?php $this->endWidget(); ?>
<!-- End Of Search Form -->
</div>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'penjualan-form',
        'type'=>'horizontal',
        
        'enableAjaxValidation'=>false,
        'enableClientValidation'=>true,
        
        'clientOptions'=>array(
                'validateOnSubmit'=>true,
        ),
        /*
        'htmlOptions'=>array(
                'onsubmit'=>"return false;",
                'onkeypress'=>" if(event.keyCode == 13){ send(); } "
        ),
        */
)); ?>

<div>
  <?php //echo $form->label($customer,Yii::t('messages','Customer Name')); ?>
  <?php //echo $form->hiddenField($customer,'id',array()); ?>
  <?php
	/*
	$this->widget('zii.widgets.jui.CJuiAutoComplete',
    array(
      'model'=>$customer,
      'attribute'=>'name',
	  
      'source'=>$this->createUrl('customer/autocomplete'),
      'htmlOptions'=>array('placeholder'=>'Any'),
      'options'=>
         array(
               'showAnim'=>'fold',
               'select'=>"js:function(customer, ui) {
					$('#DetailKendaraan_customer_id').val(ui.item.id);
					$('#Penjualan_customer_id').val(ui.item.id);
                }",
				
        ),
      'cssFile'=>false,
    )); 
	*/
	?>
</div>

	<?php //echo $form->errorSummary($model); ?>
        
        <?php if(Yii::app()->user->hasFlash('Success')): ?>

        <div class="alert alert-success">
            <?php echo Yii::app()->user->getFlash('Success'); ?>
        </div>

        <?php endif; ?>
		
        <?php if(Yii::app()->user->hasFlash('Error')): ?>

        <div class="alert alert-error">
                <?php echo Yii::app()->user->getFlash('Error'); ?>
        </div>

        <?php endif; ?>

	<?php echo $form->errorSummary($penjualan); ?>
	
	<p class="help-block">Fields with <span class="required">*</span> are required.</p>
        
        <div id="customer" style="display:<?php if(isset($customer->id)){echo 'none;'; } ?>">
        <fieldset>
            <legend>Customer</legend>
                <?php if(empty($customer->id)){ ?>
                <?php echo $form->textFieldRow($customer,'no_ktp',array('class'=>'span5','maxlength'=>128, 'value'=>$_GET['ktp'])); ?>
                <?php } ?>
                <?php echo $form->textFieldRow($customer,'name',array('class'=>'span5','maxlength'=>128)); ?>

                <?php echo $form->textFieldRow($customer,'phone',array('class'=>'span5','maxlength'=>16)); ?>
                <?php echo $form->textFieldRow($customer,'mobile_phone',array('class'=>'span5','maxlength'=>16)); ?>
                <?php echo $form->textFieldRow($customer,'alamat',array('class'=>'span5','maxlength'=>128)); ?>
                <?php echo $form->dropDownListRow($customer, 'propinsi_id', isset($customer->propinsi_id)?CHtml::listData(Propinsi::model()->findAll(array('condition'=>'negara_id="114"')), 'id', 'name'):CHtml::listData(Propinsi::model()->findAll(array('condition'=>'negara_id="114"')), 'id', 'name'),
                    array('prompt'=>isset($customer->propinsi_id)?NULL:'Pilih Propinsi',
                    'ajax' => array(
                    'type'=>'GET', 
                    'url'=>CController::createUrl('customer/loadkota'),
                    'update'=>'#Customer_kota_id', 
                    'data'=>array('propinsi_id'=>'js:this.value'),                            
                    )
                    )); 
                ?>

                <?php 
                //$propinsi_id = Yii::app()->user->bio()->propinsi_id;
                echo $form->dropDownListRow($customer, 'kota_id', isset($customer->kota_id)?CHtml::listData(Kota::model()->findAll(array('condition'=>"propinsi_id='$customer->propinsi_id'")), 'id', 'name'):CHtml::listData(Kota::model()->findAll(array('condition'=>"propinsi_id='$customer->propinsi_id'")), 'id', 'name'),
                        array('prompt'=>isset($customer->kota_id)?NULL:'Pilih Kota',
                        )); 
                ?>
        </fieldset>
        </div>
        
        <fieldset>
            <legend>Sale Items</legend>
            
                <?php if(empty($_GET['code'])){
                        echo $form->dropDownListRow($detailPenjualan, 'tipe_penjualan_id', CHtml::listData(TipePenjualan::model()->findAll(), 'id', 'label'));
                      } 
                      else{
                        echo $form->dropDownListRow($detailPenjualan, 'tipe_penjualan_id', CHtml::listData(TipePenjualan::model()->findAll(array('condition'=>"id <> 2")), 'id', 'label'));
                      }
                ?>
                <!-- Form Kode Garansi Muncul ketika tipe penjualan adalah penggantian -->
                <div id="DetailPenjualanKodeGaransi" style="display:none;">
                <?php echo $form->textFieldRow($detailPenjualan, 'kode_garansi', array('class'=>'span5', 'maxLength'=>12, 'value'=>'000000000', 'placeholder'=>'Kode garansi yang diganti')); ?>
                </div>
                
                <div id="DetailPenjualanHarga" style="display:none;">
                <?php echo $form->textFieldRow($detailPenjualan,'harga',array('prepend'=>'Rp.', 'class'=>'span9', 'value'=>'0', 'placeholder'=>'Harga toko')); ?>
                </div>
                
                <div id="DetailPenjualanKeterangan" style="display:none;">
                <?php echo $form->textAreaRow($detailPenjualan,'keterangan',array('class'=>'span5', 'placeholder'=>'Keterangan')); ?>
                </div>
                
                <?php echo $form->dropDownListRow($detailPenjualan, 'product_category_id', CHtml::listData(ProductCategory::model()->findAll(), 'id', 'name'),
                        array('prompt'=>'Kategori Produk',
                            'ajax' => array(
                            'type'=>'GET', 
                            'url'=>CController::createUrl('penjualan/loadmerk'),
                            'update'=>'#DetailPenjualan_merk_product_id', 
                            'data'=>array('cat'=>'js:this.value'),                            
                            )
                        )); 
                ?>
                <?php echo $form->dropDownListRow($detailPenjualan,'merk_product_id', CHtml::listData(MerkProduct::model()->findAll(), 'id', 'name'),
                            array('prompt'=>'Pilih Merk',
                                  'ajax' => array(
                                  'type'=>'GET', 
                                  'url'=>CController::createUrl('penjualan/loadproduct'),
                                  'update'=>'#DetailPenjualan_product_id', 
                                  'data'=>array('merk'=>'js:this.value'),
                                  )
                            )                     
                        ); ?>

                <?php echo $form->dropDownListRow($detailPenjualan, 'product_id', CHtml::listData(Product::model()->findAll(), 'id', 'name')); ?>


                <div id="jumlah" style="display:none;">
                <?php echo $form->textFieldRow($detailPenjualan,'jumlah',array('class'=>'span5', 'value'=>'1', 'maxlength'=>'2')); ?>
                </div>

                <div id="nonAki" style="display:none" >   
                    <?php echo $form->datepickerRow($detailPenjualan,'tanggal_produksi',array('prepend'=>'<i class="icon-calendar"></i>', 'value' => date('d-m-Y'))); ?>

                    <?php echo $form->textFieldRow($detailPenjualan,'kode_produksi',array('class'=>'span5')); ?>
                </div>

        </fieldset>
        <!-- End Of Detail Penjualan -->
        

        <?php if($customer->id===NULL) { ?>
            <fieldset>
                <legend>Kendaraan</legend>

                    <?php echo $form->dropDownListRow($kendaraan, 'jenis_kendaraan_id', isset($kendaraan->jenis_kendaraan_id)?CHtml::listData(JenisKendaraan::model()->findAll(), 'id', 'name'):CHtml::listData(JenisKendaraan::model()->findAll(), 'id', 'name'),
                            array('prompt'=>isset($kendaraan->jenis_kendaraan_id)?NULL:'Pilih Jenis Kendaraan',
                            )); 
                    ?>
                    <?php echo $form->dropDownListRow($kendaraan, 'merk_kendaraan_id', isset($kendaraan->merk_kendaraan_id)?CHtml::listData(MerkKendaraan::model()->findAll(), 'id', 'name'):CHtml::listData(MerkKendaraan::model()->findAll(), 'id', 'name'),
                            array('prompt'=>isset($kendaraan->merk_kendaraan_id)?NULL:'Pilih Merk',
                            )); 
                    ?>

                    <?php echo $form->hiddenField($kendaraan,'no_mesin',array('class'=>'span5','maxlength'=>32)); ?>
                    
                    <?php
                            echo $form->textFieldRow($detailKendaraan, 'nopol', array('class'=>'span5', 'maxlength'=>16));
                    ?>

                    <?php echo $form->textFieldRow($kendaraan,'tahun_kendaraan',array('class'=>'span5','maxlength'=>32)); ?>
            </fieldset>
        <?php } ?>
		
        <div id="logKendaraan" style="display:none;">
            <fieldset>
                <legend>Log Kendaraan</legend>
                    <?php echo $form->dropDownListRow($logKendaraan, 'modifikasi_id', isset($logKendaraan->modifikasi_id)?CHtml::listData(Modifikasi::model()->findAll(), 'id', 'description'):CHtml::listData(Modifikasi::model()->findAll(), 'id', 'description'),
                          array('prompt'=>isset($logKendaraan->modifikasi_id)?NULL:'Modifikasi',
                          )); 
                    ?>

                    <?php echo $form->dropDownListRow($logKendaraan, 'masalah_id', isset($logKendaraan->masalah_id)?CHtml::listData(Masalah::model()->findAll(), 'id', 'description'):CHtml::listData(Masalah::model()->findAll(), 'id', 'description'),
                          array('prompt'=>isset($logKendaraan->masalah_id)?NULL:'Masalah',
                          )); 
                    ?>

                    <?php echo $form->dropDownListRow($logKendaraan, 'beban_id', isset($logKendaraan->beban_id)?CHtml::listData(Beban::model()->findAll(), 'id', 'description'):CHtml::listData(Beban::model()->findAll(), 'id', 'description'),
                          array('prompt'=>isset($logKendaraan->beban_id)?NULL:'Beban',
                          )); 
                    ?>

                    <?php echo $form->dropDownListRow($logKendaraan, 'pegawai_id', isset($logKendaraan->pegawai_id)?CHtml::listData(Pegawai::model()->findAll(array('condition'=>'jabatan_id=4')), 'id', 'name'):CHtml::listData(Pegawai::model()->findAll(array('condition'=>'jabatan_id=4')), 'id', 'name'),
                          array('prompt'=>isset($logKendaraan->pegawai_id)?NULL:'Pilih Teknisi',
                          )); 
                    ?>
                    
                <div id="div_LogKendaraan_detail_kendaraan_id">
                    <?php 
                            if(isset($_GET['ktp'])){
                                    $cust = $_GET['ktp']; 
                    ?>
                    <?php 
                                    $customer = Customer::model()->find(array('condition'=>"no_ktp=$cust")); ?>
                    <?php 
                                    if($customer===null){
                    ?>
                    <?php 
                                        echo $form->hiddenField($logKendaraan, 'detail_kendaraan_id'); 
                    ?>
                    <?php
                                    }
                                    else{
                                        echo $form->dropDownListRow($logKendaraan, 'detail_kendaraan_id', isset($logKendaraan->detail_kendaraan_id)?CHtml::listData(DetailKendaraan::model()->findAll(array('condition'=>"customer_id=$customer->no_ktp")), 'uid', 'nopol'):CHtml::listData(DetailKendaraan::model()->findAll(array('condition'=>"customer_id=$customer->no_ktp")), 'uid', 'nopol'),
                                                array('prompt'=>isset($logKendaraan->detail_kendaraan_id)?NULL:'Pilih Kendaraan',
                                        )); 
                                    }
                            }
                            else{
                                echo $form->dropDownListRow($logKendaraan, 'detail_kendaraan_id', isset($logKendaraan->detail_kendaraan_id)?CHtml::listData(DetailKendaraan::model()->findAll(array('condition'=>"customer_id=$customer->no_ktp")), 'uid', 'nopol'):CHtml::listData(DetailKendaraan::model()->findAll(array('condition'=>"customer_id=$customer->no_ktp")), 'uid', 'nopol'),
                                        array('prompt'=>isset($logKendaraan->detail_kendaraan_id)?NULL:'Pilih Kendaraan',
                                )); 
                            }
                    ?>
                </div>
				
                    <?php echo $form->dropDownListRow($logKendaraan, 'kondisi_id', isset($logKendaraan->kondisi_id)?CHtml::listData(Kondisi::model()->findAll(), 'id', 'description'):CHtml::listData(Kondisi::model()->findAll(), 'id', 'description'),
                          array('prompt'=>isset($logKendaraan->kondisi_id)?NULL:'Kondisi',
                          )); 
                    ?>
					
                    <?php
                            echo $form->textFieldRow($logKendaraan, 'km_awal', array('class'=>'span5', 'maxlength'=>16));
                    ?>

	</fieldset>
	</div>
	
	<?php 
		if(isset($customer->id) && $customer->no_ktp!='0'){
	?>
	<div id="FormNewKendaraan">
	<fieldset>
		<legend>
			Form Kendaraan Baru
		</legend>
					
                        <?php
                                $newKendaraan = new Kendaraan;

                                echo $form->dropDownListRow($newKendaraan, 'jenis_kendaraan_id', isset($newKendaraan->jenis_kendaraan_id)?CHtml::listData(JenisKendaraan::model()->findAll(), 'id', 'name'):CHtml::listData(JenisKendaraan::model()->findAll(), 'id', 'name'),
                                                array('prompt'=>isset($newKendaraan->jenis_kendaraan_id)?NULL:'Jenis Kendaraan',
                                                )); 

                                echo $form->dropDownListRow($newKendaraan, 'merk_kendaraan_id', isset($newKendaraan->merk_kendaraan_id)?CHtml::listData(MerkKendaraan::model()->findAll(array('condition'=>"kd_merk <> ''")), 'kd_merk', 'name'):CHtml::listData(MerkKendaraan::model()->findAll(array('condition'=>"kd_merk <> ''")), 'kd_merk', 'name'),
                                                array(
                                                    'prompt'=>isset($newKendaraan->merk_kendaraan_id)?NULL:'Pilih Merk Kendaraan',
                                                    'ajax' => array(
                                                    'type'=>'GET', 
                                                    'url'=>CController::createUrl('tipeKendaraan/ajax'),
                                                    'update'=>'#Kendaraan_tipe_kendaraan_id', 
                                                    'data'=>array('merk'=>'js:this.value'),                            
                                                    )                                                    
                                )); 
                                
                                echo $form->dropDownListRow($newKendaraan, 'tipe_kendaraan_id', array());
                        ?>
                        <?php
                                echo $form->textFieldRow($newKendaraan, 'tahun_kendaraan', array('class'=>'span5'));
                        ?>					
                        <?php
                                echo $form->hiddenField($newKendaraan, 'no_mesin', array('class'=>'span5'));
                        ?>

                        <?php
                                $newDetailKendaraan = new DetailKendaraan;
                                echo $form->textFieldRow($newDetailKendaraan, 'nopol', array('class'=>'span5'));
                        ?>
					
			<?php 
				if(isset($customer->id)){ 
					echo $form->hiddenField($newDetailKendaraan,'customer_id',array('class'=>'span5', 'value'=>$customer->id));
				}
				else{
					echo $form->hiddenField($newDetailKendaraan,'customer_id',array('class'=>'span5'));
				}
			?>

                        <?php echo $form->hiddenField($logKendaraan,'date',array('value'=>date('Y-m-d'))); ?>
            </fieldset>
        </div>
		<?php
			}
		?>
        <!-- Form Penjualan -->
        <fieldset>
            <legend>Total</legend>
                <?php echo $form->hiddenField($penjualan,'user_role_id',array('class'=>'span5', 'value'=>Yii::app()->user->get()->id)); ?>

                <?php 
                        if(isset($customer->id)){ 
                                echo $form->hiddenField($penjualan,'customer_id',array('class'=>'span5', 'value'=>$customer->no_ktp));
                        }
                        else{
                                echo $form->hiddenField($penjualan,'customer_id',array('class'=>'span5'));
                        }
                ?>
            
                <?php
                    echo $form->hiddenField($penjualan, 'kd_penjualan', array('class'=>'span5', 'value'=>'0'));
                ?>
                <h3 class="well">
                        <div id="total_penjualan">
                                Rp. <?php echo Yii::app()->session['total_penjualan']; ?>
                        </div>
                </h3>
        <!-- End Of Penjualan -->
        </fieldset>
        
	<div class="form-actions">
                <?php if($penjualan->save !='yes' && $penjualan->parent_id == $penjualan->kd_penjualan){ ?>
                <?php $this->widget('bootstrap.widgets.TbButton', array(
                        'buttonType'=>'submit',
                        'type'=>'primary',
                        'label'=>$penjualan->isNewRecord ? 'Submit' : 'Submit',
                        //'icon'  =>'icon-hdd',
                        //'loadingText'=>'loading...',
                )); ?>
                <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'reset', 'label'=>'Reset')); ?>
                <?php } ?>
	</div>
       

<?php //$this->endWidget(); ?>

<?php

$gridDataProvider = new CArrayDataProvider(DetailPenjualan::model()->findAll(array('order'=>'t.id desc', 'with'=>array('penjualan', 'logKendaraan'), 'condition'=>"t.penjualan_id='$penjualan->kd_penjualan'")));
 
// $gridColumns
$gridColumns = array(
	array(
	  'header'=>'No.',
		'htmlOptions' => array('style'=>'width:40px;'),
	  'value'=>'$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
	),
	array(
		'name'=>'product.merkProduct.name', 
		'header'=>'Merk',
	),
        array(
                'name'=>'product.name',
                'header'=>'Tipe'
        ),
	array('name'=>'jumlah', 'header'=>'Jumlah'),
	array('name'=>'total_harga', 'header'=>'Total'),
	array(
		'htmlOptions' => array('nowrap'=>'nowrap'),
		'class'=>'bootstrap.widgets.TbButtonColumn',
                
        'template'=>"{update}{delete}",
		'viewButtonUrl'=>'Yii::app()->createUrl("detailPenjualan/view/".$data["t"]["id"])',
		'updateButtonUrl'=>'Yii::app()->createUrl("logKendaraan/update/".$data["logKendaraan"]["id"])',
		'deleteButtonUrl'=>'Yii::app()->createUrl("detailPenjualan/delete/".$data["id"])',
	)
);

$this->widget('bootstrap.widgets.TbGridView', array(
        'type'=>"striped bordered",
	'dataProvider'=>$gridDataProvider,
	//'template'=>"{items}",
	'columns'=>$gridColumns,
));
?>
        
        <div class="form-actions">
                <?php
                    if(isset($penjualan->code) && $penjualan->code!=''){
                ?>
		<?php $this->widget('bootstrap.widgets.TbButton',array(
                        'label' => 'Save',
                        'type'  => 'success',
                        'url'  => Yii::app()->createUrl('penjualan/save/', array('code'=>$penjualan->code, 'cust'=>$penjualan->customer_id)),
                        'icon'=>'icon-download-alt'
                ));?>
                <?php
                    }
                ?>
        </div>
        
<?php $this->endWidget(); ?>

<script type="text/javascript">
    $(document).ready(function() {
        
        
                //All Javascript Handler
                //Sani Iman Pribadi
                //@jagoaki 2013
                
                $('#DetailPenjualan_product_category_id').change(function(){
                    var id = $('#DetailPenjualan_product_category_id').val();
                    if(id == '1' || id =='2'){
                        $('#jumlah').hide();
                        $('#logKendaraan').show();
                        $('#nonAki').show();
                    }
                    else{
                        $('#jumlah').show();
                        $('#logKendaraan').hide();
                        $('#nonAki').hide();
                    }
                })

                $('a.delete').click(function(){

                })

                <?php
                    if(isset($_GET['code']) && $_GET['code']!=""){
                ?>

                $('#total_penjualan').load('<?php echo Yii::app()->createUrl('penjualan/totalPenjualan/', array('kd_penjualan'=>$penjualan->kd_penjualan)); ?>');

                <?php
                    }
                ?>
                        
                        
                //Action when tipe penjualan id = 2 or id = 4
                $('#DetailPenjualan_tipe_penjualan_id').change(function(){
                    
                    //define var tipe penjualan id
                    var tipePenjualanId = $('#DetailPenjualan_tipe_penjualan_id').val();
                    
                    //condition when penjualan id = 2 ( penggantian )
                    if(tipePenjualanId == '2'){
                        $('#DetailPenjualanKodeGaransi').show();
                        $('#DetailPenjualanHarga').hide();
                        $('#DetailPenjualan_kode_garansi').val('');
                    }
                    else{
                        $('#DetailPenjualanKodeGaransi').hide();
                        $('#DetailPenjualanKeterangan').hide();
                        $('#DetailPenjualan_kode_garansi').val('000000000');
                    }
                    
                    //condition when penjualan id = 4 ( garansi toko )
                    if(tipePenjualanId == '4'){
                        $('#DetailPenjualanHarga').show();
                        $('#DetailPenjualanKodeGaransi').hide();
                        $('#DetailPenjualan_kode_garansi').val('000000000');
                    }
                    else{
                        $('#DetailPenjualanHarga').hide();
                        
                    }
                    
                    if(tipePenjualanId == '2' || tipePenjualanId == '3' || tipePenjualanId == '4'){
                        $('#DetailPenjualanKeterangan').show();
                    }
                    else{
                        $('#DetailPenjualanKeterangan').hide();
                    }
                })
		
		
		
		$('#LogKendaraan_detail_kendaraan_id').change(function(){
                    var kendaraan = $('#LogKendaraan_detail_kendaraan_id').val();
                    if(kendaraan!=""){

                            $('#Kendaraan_jenis_kendaraan_id').val('5');
                            $('#Kendaraan_tahun_kendaraan').val('0000');
                            $('#Kendaraan_merk_kendaraan_id').val('144');
                            $('#FormNewKendaraan').hide();

                    }
                    else{
                            $('#Kendaraan_jenis_kendaraan_id').val('');
                            $('#Kendaraan_tahun_kendaraan').val('');
                            $('#Kendaraan_merk_kendaraan_id').val('');
                            $('#Kendaraan_no_mesin').val('');
                            $('#DetailKendaraan_nopol').val('');
                            $('#FormNewKendaraan').show();
                    }
		});
		
		$('#DetailPenjualan_product_category_id').change(function(){
                    var tipePenjualan = $('#DetailPenjualan_product_category_id').val();
                    if(tipePenjualan==3 || tipePenjualan==4 || tipePenjualan==5 || tipePenjualan==6){
                            
                            $('#Kendaraan_jenis_kendaraan_id').val('5');
                            $('#Kendaraan_tahun_kendaraan').val('0000');
                            $('#Kendaraan_merk_kendaraan_id').val('144');
                            $('#FormNewKendaraan').hide();
                    }
                    else{
                        if(tipePenjualan==1 || tipePenjualan==2){
                            if($('#Penjualan_customer_id').val()=='0'){
                                if(tipePenjualan==1){
                                    $('#LogKendaraan_detail_kendaraan_id').val('100000');
                                    $('#div_LogKendaraan_detail_kendaraan_id').hide();//('readonly', true);
                                }
                                else{
                                    $('#LogKendaraan_detail_kendaraan_id').val('200000');
                                    $('#div_LogKendaraan_detail_kendaraan_id').hide();//('readonly', true);
                                }
                                
                            }
                            $('#FormNewKendaraan').show();
                        }
                    }
		});
		
		$('#Kendaraan_jenis_kendaraan_id').change(function(){
			var jenis_kendaraan_id = $('#Kendaraan_jenis_kendaraan_id').val();
			if(jenis_kendaraan_id=="5" || jenis_kendaraan_id=="6"){
				$('#Kendaraan_tahun_kendaraan').val('0000');
				$('#Kendaraan_tahun_kendaraan').prop('readonly', true);
				$('#Kendaraan_merk_kendaraan_id').val('144');
				$('#Kendaraan_merk_kendaraan_id').prop('readonly', true);
				$('#Kendaraan_no_mesin').prop('readonly', true);
				$('#DetailKendaraan_nopol').prop('readonly', true)
			}
			else{
				$('#Kendaraan_tahun_kendaraan').prop('disabled', false);
				$('#Kendaraan_merk_kendaraan_id').prop('disabled', false);
				$('#Kendaraan_no_mesin').prop('disabled', false);
				$('#DetailKendaraan_nopol').prop('disabled', false)
			}
		});
		
        
 

    });
</script>