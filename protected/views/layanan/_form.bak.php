<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'layananForm',
        'type'=>'horizontal',
        'enableAjaxValidation'=>false,
        'enableClientValidation'=>true,
        'clientOptions'=>array(
                'validateOnSubmit'=>true,
        ),
	'htmlOptions'=>array('class'=>'well'),
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'detail_kendaraan_id',array('class'=>'span5')); ?>

        <?php echo $form->dropDownListRow($model, 'teknisi_id', isset($model->teknisi_id)?CHtml::listData(Pegawai::model()->findAll(array('condition'=>'jabatan_id=4')), 'id', 'name'):CHtml::listData(Pegawai::model()->findAll(array('condition'=>'jabatan_id=4')), 'id', 'name'),
              array('prompt'=>isset($model->teknisi_id)?NULL:'Pilih Teknisi',
              )); 
        ?>

	<?php echo $form->textFieldRow($model,'nomor',array('class'=>'span5','maxlength'=>16)); ?>

	<?php echo $form->textFieldRow($model,'km',array('class'=>'span5','maxlength'=>64)); ?>

	<?php echo $form->textFieldRow($model,'volt',array('class'=>'span5','maxlength'=>16)); ?>

	<?php echo $form->textFieldRow($model,'v_starter',array('class'=>'span5','maxlength'=>16)); ?>

	<?php echo $form->textFieldRow($model,'load_off',array('class'=>'span5','maxlength'=>16)); ?>

	<?php echo $form->textFieldRow($model,'load_on',array('class'=>'span5','maxlength'=>16)); ?>

	<?php echo $form->textFieldRow($model,'isi_air_aki',array('class'=>'span5','maxlength'=>16)); ?>

	<?php //echo $form->textFieldRow($model,'date_create',array('class'=>'span5')); ?>

	<?php //echo $form->textFieldRow($model,'date_max_return',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
