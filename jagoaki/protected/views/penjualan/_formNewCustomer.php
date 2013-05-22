<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'customer-form',
        'type'=>'horizontal',
        'enableAjaxValidation'=>false,
        'enableClientValidation'=>true,
        'clientOptions'=>array(
                'validateOnSubmit'=>true,
        ),
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

        <?php echo $form->dropDownListRow($model, 'customer_info_id', isset($model->customer_info_id)?CHtml::listData(CustomerInfo::model()->findAll(), 'id', 'name'):CHtml::listData(CustomerInfo::model()->findAll(), 'id', 'name'),
                array('prompt'=>isset($model->customer_info_id)?NULL:'Pilih Customer Info',
                )); 
        ?>

        <?php echo $form->dropDownListRow($model, 'customer_category_id', isset($model->customer_category_id)?CHtml::listData(CustomerCategory::model()->findAll(), 'id', 'name'):CHtml::listData(CustomerCategory::model()->findAll(), 'id', 'name'),
                array('prompt'=>isset($model->customer_category_id)?NULL:'Pilih Customer Category',
                )); 
        ?>

        <?php echo $form->dropDownListRow($model, 'propinsi_id', isset($model->propinsi_id)?CHtml::listData(Propinsi::model()->findAll(array('condition'=>'negara_id="114"')), 'id', 'name'):CHtml::listData(Propinsi::model()->findAll(array('condition'=>'negara_id="114"')), 'id', 'name'),
                array('prompt'=>isset($model->propinsi_id)?NULL:'Pilih Propinsi',
                        'ajax' => array(
                        'type'=>'GET', 
                        'url'=>CController::createUrl('customer/loadkota'),
                        'update'=>'#Customer_kota_id', 
                        'data'=>array('propinsi_id'=>'js:this.value'),                            
                        )
                )); 
        ?>

        <?php echo $form->dropDownListRow($model,'kota_id', array(), array('prompt'=>'Pilih Kota')); ?>

	<?php echo $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>128)); ?>

	<?php echo $form->textFieldRow($model,'email',array('class'=>'span5','maxlength'=>128)); ?>

	<?php echo $form->textFieldRow($model,'phone',array('class'=>'span5','maxlength'=>64)); ?>

	<?php echo $form->textFieldRow($model,'mobile_phone',array('class'=>'span5','maxlength'=>64)); ?>

	<?php echo $form->hiddenField($model,'no_ktp',array('class'=>'span5','maxlength'=>32, 'value'=>$no)); ?>

	<?php //echo $form->textFieldRow($model,'no_sim',array('class'=>'span5','maxlength'=>32)); ?>

	<?php echo $form->textFieldRow($model,'alamat',array('class'=>'span5','maxlength'=>256)); ?>

	<?php //echo $form->textFieldRow($model,'status',array('class'=>'span5','maxlength'=>16)); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Next' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
