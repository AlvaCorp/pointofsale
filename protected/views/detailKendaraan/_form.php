<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'detail-kendaraan-form',
        'type'=>'horizontal',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

        <?php echo $form->dropDownListRow($model, 'kendaraan_id', isset($model->kendaraan_id)?CHtml::listData(Kendaraan::model()->findAll(), 'id', 'no_mesin'):CHtml::listData(Kendaraan::model()->findAll(), 'id', 'no_mesin'),
                array('prompt'=>isset($model->kendaraan_id)?NULL:'Pilih Kendaraan',
                )); 
        ?>

        <?php echo $form->dropDownListRow($model, 'customer_id', isset($model->customer_id)?CHtml::listData(Customer::model()->findAll(), 'id', 'name'):CHtml::listData(Customer::model()->findAll(), 'id', 'name'),
                array('prompt'=>isset($model->customer_id)?NULL:'Pilih Customer',
                )); 
        ?>

	<?php echo $form->textFieldRow($model,'nopol',array('class'=>'span5','maxlength'=>16)); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
