<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'penjualan-form',
        'type'=>'horizontal',
        'enableAjaxValidation'=>false,
        'enableClientValidation'=>true,
        'clientOptions'=>array(
                'validateOnSubmit'=>true,
        ),
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($penjualan); ?>
        
        <!-- Detail Kendaraan -->
        <fieldset>
            <legend>Detail Kendaraan</legend>
	<?php echo $form->textFieldRow($detailKendaraan,'kendaraan_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($detailKendaraan,'customer_id',array('class'=>'span5')); ?>
        </fieldset>
        <!-- End Of Detail Kendaraan -->
        
        <!-- Log Kendaraan -->
        <fieldset>
            <legend>Log Kendaraan</legend>
        <?php echo $form->dropDownListRow($logKendaraan, 'modifikasi_id', isset($logKendaraan->modifikasi_id)?CHtml::listData(Modifikasi::model()->findAll(), 'id', 'description'):CHtml::listData(Modifikasi::model()->findAll(), 'id', 'description'),
                array('prompt'=>isset($logKendaraan->modifikasi_id)?NULL:'Pilih Modifikasi',
                )); 
        ?>

        <?php echo $form->dropDownListRow($logKendaraan, 'masalah_id', isset($logKendaraan->masalah_id)?CHtml::listData(Masalah::model()->findAll(), 'id', 'description'):CHtml::listData(Masalah::model()->findAll(), 'id', 'description'),
                array('prompt'=>isset($logKendaraan->masalah_id)?NULL:'Pilih Masalah',
                )); 
        ?>

        <?php echo $form->dropDownListRow($logKendaraan, 'beban_id', isset($logKendaraan->beban_id)?CHtml::listData(Beban::model()->findAll(), 'id', 'description'):CHtml::listData(Beban::model()->findAll(), 'id', 'description'),
                array('prompt'=>isset($logKendaraan->beban_id)?NULL:'Pilih Beban',
                )); 
        ?>

        <?php echo $form->dropDownListRow($logKendaraan, 'teknisi_id', isset($logKendaraan->teknisi_id)?CHtml::listData(Teknisi::model()->findAll(), 'id', 'name'):CHtml::listData(Teknisi::model()->findAll(), 'id', 'name'),
                array('prompt'=>isset($logKendaraan->teknisi_id)?NULL:'Pilih Teknisi',
                )); 
        ?>

	<?php //echo $form->textFieldRow($logKendaraan,'detail_kendaraan_id',array('class'=>'span5')); ?>

        <?php echo $form->dropDownListRow($logKendaraan, 'kondisi_id', isset($logKendaraan->kondisi_id)?CHtml::listData(Kondisi::model()->findAll(), 'id', 'description'):CHtml::listData(Kondisi::model()->findAll(), 'id', 'description'),
                array('prompt'=>isset($logKendaraan->kondisi_id)?NULL:'Pilih Kondisi',
                )); 
        ?>
            
        <?php echo $form->dropDownListRow($logKendaraan, 'tahun_kendaraan_id', isset($logKendaraan->tahun_kendaraan_id)?CHtml::listData(TahunKendaraan::model()->findAll(), 'id', 'description'):CHtml::listData(TahunKendaraan::model()->findAll(), 'id', 'description'),
                array('prompt'=>isset($logKendaraan->tahun_kendaraan_id)?NULL:'Pilih Tahun Kendaraan',
                )); 
        ?>

	<?php echo $form->textFieldRow($logKendaraan,'date',array('class'=>'span5')); ?>
        </fieldset>
        <!-- End Of Log Kendaraan -->
        
        
        <!-- Form Penjualan -->
        <fieldset>
            <legend>Penjualan</legend>
	<?php //echo $form->textFieldRow($penjualan,'penjualan_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($penjualan,'user_role_id',array('class'=>'span5', 'value'=>Yii::app()->user->get()->id)); ?>

	<?php //echo $form->textFieldRow($penjualan,'log_kendaraan_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($penjualan,'customer_id',array('class'=>'span5')); ?>

	<?php //echo $form->textFieldRow($penjualan,'kd_penjualan',array('class'=>'span5','maxlength'=>256)); ?>

	<?php //echo $form->textFieldRow($penjualan,'date',array('class'=>'span5')); ?>

	<?php //echo $form->textFieldRow($penjualan,'total',array('class'=>'span5','maxlength'=>32)); ?>

	<?php //echo $form->textFieldRow($penjualan,'bayar',array('class'=>'span5','maxlength'=>32)); ?>
        <!-- End Of Penjualan -->
        </fieldset>
        <!-- Detail Penjualan -->
        <fieldset>
            <legend>Detail Penjualan</legend>
	<?php echo $form->textFieldRow($detailPenjualan,'parent_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($detailPenjualan,'product_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($detailPenjualan,'jumlah',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($detailPenjualan,'total_harga',array('class'=>'span5')); ?>
        </fieldset>
        <!-- End Of Detail Penjualan -->
        


	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$penjualan->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
