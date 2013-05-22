<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'teknisi-form',
        'type'=>'horizontal',
        'enableAjaxValidation'=>false,
        'enableClientValidation'=>true,
        'clientOptions'=>array(
                'validateOnSubmit'=>true,
        ),
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

        <?php echo $form->dropDownListRow($model, 'user_id', isset($model->user_id)?CHtml::listData(User::model()->findAll(), 'id', 'name'):CHtml::listData(User::model()->findAll(), 'id', 'name'),
                array('prompt'=>isset($model->user_id)?NULL:'Pilih User',
                )); 
        ?>
        
        <?php echo $form->dropDownListRow($model, 'jabatan_id', isset($model->jabatan_id)?CHtml::listData(Jabatan::model()->findAll(), 'id', 'name'):CHtml::listData(Jabatan::model()->findAll(), 'id', 'name'),
                array('prompt'=>isset($model->jabatan_id)?NULL:'Pilih Jabatan',
                )); 
        ?>

        <?php echo $form->dropDownListRow($model, 'propinsi_id', isset($model->propinsi_id)?CHtml::listData(Propinsi::model()->findAll(array('condition'=>'negara_id="114"')), 'id', 'name'):CHtml::listData(Propinsi::model()->findAll(array('condition'=>'negara_id="114"')), 'id', 'name'),
                array('prompt'=>isset($model->propinsi_id)?NULL:'Pilih Propinsi',
                        'ajax' => array(
                        'type'=>'GET', 
                        'url'=>CController::createUrl('customer/loadkota'),
                        'update'=>'#Pegawai_kota_id', 
                        'data'=>array('propinsi_id'=>'js:this.value'),                            
                        )
                )); 
        ?>

        <?php 
        $propinsi_id = Yii::app()->user->bio()->propinsi_id;
        echo $form->dropDownListRow($model, 'kota_id', isset($model->kota_id)?CHtml::listData(Kota::model()->findAll(array('condition'=>"propinsi_id='$propinsi_id'")), 'id', 'name'):CHtml::listData(Kota::model()->findAll(array('condition'=>"propinsi_id='$propinsi_id'")), 'id', 'name'),
                array('prompt'=>isset($model->kota_id)?NULL:'Pilih Kota',
                )); 
        ?>

	<?php echo $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>128)); ?>

	<?php echo $form->textFieldRow($model,'alamat',array('class'=>'span5','maxlength'=>512)); ?>

	<?php echo $form->textFieldRow($model,'email',array('class'=>'span5','maxlength'=>128)); ?>

	<?php echo $form->textFieldRow($model,'phone',array('class'=>'span5','maxlength'=>64)); ?>

	<?php echo $form->textFieldRow($model,'mobile_phone',array('class'=>'span5','maxlength'=>64)); ?>
        


        <?php echo $form->dropDownListRow($model, 'status', isset($model->status)?CHtml::listData(PegawaiStatus::model()->findAll(), 'id', 'name'):CHtml::listData(PegawaiStatus::model()->findAll(), 'id', 'name'),
                array('prompt'=>isset($model->pegawai_status)?NULL:'Status Pegawai',
                )); 
        ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
