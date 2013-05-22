<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'kendaraan-form',
        'type'=>'horizontal',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php //echo $form->textFieldRow($model,'merk_kendaraan_id',array('class'=>'span5')); ?>
        
        <?php echo $form->dropDownListRow($model, 'merk_kendaraan_id', isset($model->merk_kendaraan_id)?CHtml::listData(MerkKendaraan::model()->findAll(), 'id', 'name'):CHtml::listData(MerkKendaraan::model()->findAll(), 'id', 'name'),
                array('prompt'=>isset($model->merk_kendaraan_id)?NULL:'Pilih Merk',
                )); 
        ?>

	<?php //echo $form->textFieldRow($model,'jenis_kendaraan_id',array('class'=>'span5')); ?>
        
        <?php echo $form->dropDownListRow($model, 'jenis_kendaraan_id', isset($model->jenis_kendaraan_id)?CHtml::listData(JenisKendaraan::model()->findAll(), 'id', 'name'):CHtml::listData(JenisKendaraan::model()->findAll(), 'id', 'name'),
                array('prompt'=>isset($model->jenis_kendaraan_id)?NULL:'Pilih Jenis Kendaraan',
                )); 
        ?>

	<?php //echo $form->textFieldRow($model,'kategori_kendaraan_id',array('class'=>'span5')); ?>
        
        <?php echo $form->dropDownListRow($model, 'kategori_kendaraan_id', isset($model->kategori_kendaraan_id)?CHtml::listData(KategoriKendaraan::model()->findAll(), 'id', 'name'):CHtml::listData(KategoriKendaraan::model()->findAll(), 'id', 'name'),
                array('prompt'=>isset($model->kategori_kendaraan_id)?NULL:'Pilih Kategori Kendaraan',
                )); 
        ?>

	<?php //echo $form->textFieldRow($model,'bahan_bakar_id',array('class'=>'span5')); ?>
        
          <?php echo $form->dropDownListRow($model, 'bahan_bakar_id', isset($model->product_category_id)?CHtml::listData(BahanBakar::model()->findAll(), 'id', 'name'):CHtml::listData(BahanBakar::model()->findAll(), 'id', 'name'),
                array('prompt'=>isset($model->bahan_bakar_id)?NULL:'Pilih Bahan Bakar',
                )); 
        ?>

	<?php echo $form->textFieldRow($model,'no_kendaraan',array('class'=>'span5','maxlength'=>16)); ?>

	<?php echo $form->textFieldRow($model,'no_mesin',array('class'=>'span5','maxlength'=>32)); ?>
        
        <?php echo $form->textFieldRow($model,'tahun_kendaraan',array('class'=>'span5','maxlength'=>4)); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Next',
		)); ?>
	</div>

<?php $this->endWidget(); ?>