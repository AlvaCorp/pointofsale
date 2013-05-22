<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'tipe-kendaraan-form',
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

	<?php //echo $form->textFieldRow($model,'merk_kendaraan_id',array('class'=>'span5')); ?>
        
        <?php echo $form->select2Row($model, 'merk_kendaraan_id', array('asDropDownList' => true, 'data' => CHtml::listData(MerkKendaraan::model()->findAll(array('condition'=>"kd_merk <> ''")), 'kd_merk', 'name'), 'options' => array(
                'placeholder' => 'Pilih Merk Kendaraan',
                'width' => '40%',
                'tokenSeparators' => array(',', ' ')
                )));
        ?>

	<?php //echo $form->textFieldRow($model,'kd_kendaraan',array('class'=>'span5','maxlength'=>16)); ?>

	<?php echo $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>128)); ?>

	<?php //echo $form->textFieldRow($model,'date_create',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
