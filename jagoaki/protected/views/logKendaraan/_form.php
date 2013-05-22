<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'log-kendaraan-form',
        'type'=>'horizontal',
        'enableAjaxValidation'=>false,
        'enableClientValidation'=>true,
        
        'clientOptions'=>array(
                'validateOnSubmit'=>true,
        ),
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
	
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
		<?php
			if($Kendaraan->jenis_kendaraan_id!=5){
		?>
        <fieldset>
            <legend>Customer</legend>
				<?php echo $form->textFieldRow($Customer,'no_ktp',array('class'=>'span5','maxlength'=>128)); ?>
				
                <?php echo $form->textFieldRow($Customer,'name',array('class'=>'span5','maxlength'=>128)); ?>
                
				<?php echo $form->textFieldRow($Customer,'phone',array('class'=>'span5','maxlength'=>16)); ?>
				<?php echo $form->textFieldRow($Customer,'mobile_phone',array('class'=>'span5','maxlength'=>16)); ?>
				<?php echo $form->textFieldRow($Customer,'alamat',array('class'=>'span5','maxlength'=>128)); ?>
        <?php echo $form->dropDownListRow($Customer, 'propinsi_id', isset($Customer->propinsi_id)?CHtml::listData(Propinsi::model()->findAll(array('condition'=>'negara_id="114"')), 'id', 'name'):CHtml::listData(Propinsi::model()->findAll(array('condition'=>'negara_id="114"')), 'id', 'name'),
                array('prompt'=>isset($Customer->propinsi_id)?NULL:'Pilih Propinsi',
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
        echo $form->dropDownListRow($Customer, 'kota_id', isset($Customer->kota_id)?CHtml::listData(Kota::model()->findAll(array('condition'=>"propinsi_id='$Customer->propinsi_id'")), 'id', 'name'):CHtml::listData(Kota::model()->findAll(array('condition'=>"propinsi_id='$Customer->propinsi_id'")), 'id', 'name'),
                array('prompt'=>isset($Customer->kota_id)?NULL:'Pilih Kota',
                )); 
        ?>
        
		</fieldset>
		<?php
			}
		?>
		<?php if($Kendaraan->jenis_kendaraan_id==6){ ?>
		<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			//'buttonType'=>'submit',
			'url'=>Yii::app()->createUrl('logKendaraan', array('garansi'=>$model->id)),
			'type'=>'success',
			'label'=>'Cetak Garansi',
		)); ?>
		</div>
		<?php }else if($Kendaraan->jenis_kendaraan_id==5){ ?>
		<div class="alert alert-info"><b>Maaf!</b> Produk ini tidak mendapatkan garansi</div>
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
					'name'=>'product.name', 
					'header'=>'Produk',
				),
				//array('name'=>'jumlah', 'header'=>'Jumlah'),
				array(
					'name'=>'penjualan.date',
					'header'=>'Tanggal'
				),
				array(
					'name'=>'penjualan.kd_penjualan',
					'header'=>'Nomor Invoice',
				),
				array(
					'name'=>'penjualan.customer.name',
					'header'=>'Customer'
				),
				//array('name'=>'total_harga', 'header'=>'Total'),
				array(
					'htmlOptions' => array('nowrap'=>'nowrap'),
					'class'=>'bootstrap.widgets.TbButtonColumn',
							
					'template'=>"{view}",
					'viewButtonUrl'=>'Yii::app()->createUrl("logKendaraan/garansi/".$data["logKendaraan"]["id"])',
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

		<?php
			}
		?>
		
	<?php
		if($Kendaraan->jenis_kendaraan_id==1 || $Kendaraan->jenis_kendaraan_id==2 || $Kendaraan->jenis_kendaraan_id==3 || $Kendaraan->jenis_kendaraan_id==4){
	?>
		<fieldset>
			<legend>
				Form Edit Data Kendaraan
			</legend>
					<?php
						
						echo $form->dropDownListRow($Kendaraan, 'jenis_kendaraan_id', isset($newKendaraan->jenis_kendaraan_id)?CHtml::listData(JenisKendaraan::model()->findAll(), 'id', 'name'):CHtml::listData(JenisKendaraan::model()->findAll(), 'id', 'name'),
								array('prompt'=>isset($Kendaraan->jenis_kendaraan_id)?NULL:'Jenis Kendaraan',
                        )); 
						
						echo $form->dropDownListRow($Kendaraan, 'merk_kendaraan_id', isset($newKendaraan->merk_kendaraan_id)?CHtml::listData(MerkKendaraan::model()->findAll(), 'id', 'name'):CHtml::listData(MerkKendaraan::model()->findAll(), 'id', 'name'),
								array('prompt'=>isset($Kendaraan->merk_kendaraan_id)?NULL:'Pilih Merk Kendaraan',
                        )); 
                    ?>
					<?php
						echo $form->textFieldRow($Kendaraan, 'tahun_kendaraan', array('class'=>'span5'));
					?>					
					<?php
						echo $form->textFieldRow($Kendaraan, 'no_mesin', array('class'=>'span5'));
					?>
					
					<?php
						echo $form->textFieldRow($DetailKendaraan, 'nopol', array('class'=>'span5'));
					?>
		</fieldset>
	<fieldset>
		<legend>
			Form Edit Log Kendaraan
		</legend>
	<?php 
		echo $form->dropDownListRow($model, 'modifikasi_id', isset($model->modifikasi_id)?CHtml::listData(Modifikasi::model()->findAll(), 'id', 'description'):CHtml::listData(Modifikasi::model()->findAll(), 'id', 'description'),
			array('prompt'=>isset($model->modifikasi_id)?NULL:'Modifikasi',
			)); 
	?>

	<?php 
		echo $form->dropDownListRow($model, 'masalah_id', isset($model->masalah_id)?CHtml::listData(Masalah::model()->findAll(), 'id', 'description'):CHtml::listData(Masalah::model()->findAll(), 'id', 'description'),
			array('prompt'=>isset($model->masalah_id)?NULL:'Masalah',
			)); 
	?>


	<?php 
		echo $form->dropDownListRow($model, 'beban_id', isset($model->beban_id)?CHtml::listData(Beban::model()->findAll(), 'id', 'description'):CHtml::listData(Beban::model()->findAll(), 'id', 'description'),
			array('prompt'=>isset($model->beban_id)?NULL:'Beban',
			)); 
	?>

	<?php 
		echo $form->dropDownListRow($model, 'kondisi_id', isset($model->kondisi_id)?CHtml::listData(Kondisi::model()->findAll(), 'id', 'description'):CHtml::listData(Kondisi::model()->findAll(), 'id', 'description'),
			array('prompt'=>isset($model->kondisi_id)?NULL:'Kondisi',
			)); 
	?>
	
	<?php
		echo $form->textFieldRow($model, 'km_awal', array('class'=>'span5', 'maxlength'=>16));
	?>
	
	<?php
		echo $form->textFieldRow($model, 'km_akhir', array('class'=>'span5', 'maxlength'=>16));
	?>
	</fieldset>
	
	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
		<?php if(isset($model->modifikasi_id) && isset($model->masalah_id) && isset($model->beban_id) && isset($model->kondisi_id) && isset($model->km_awal)){ ?>
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			//'buttonType'=>'button',
			'url'=>Yii::app()->createUrl('logKendaraan', array('garansi'=>$model->id)),
			'type'=>'success',
			'label'=>'Cetak Garansi',
		)); ?>
		<?php } ?>
	</div>
	<?php
		}
	?>

<?php $this->endWidget(); ?>
