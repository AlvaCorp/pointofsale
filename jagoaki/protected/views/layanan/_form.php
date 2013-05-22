<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'perawatan-form',
        'type'=>'horizontal',
        'enableAjaxValidation'=>false,
        'enableClientValidation'=>true,
        'clientOptions'=>array(
                'validateOnSubmit'=>true,
        ),
	'htmlOptions'=>array('class'=>'well'),
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>
        
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

	<?php echo $form->errorSummary($model); ?>

	<?php //echo $form->textFieldRow($model,'detail_kendaraan_id',array('class'=>'span5')); ?>
        
        <?php echo $form->textFieldRow($model,'kartu_garansi_id',array('class'=>'span5')); ?>

        <?php echo $form->dropDownListRow($model, 'teknisi_id', isset($model->teknisi_id)?CHtml::listData(Pegawai::model()->findAll(array('condition'=>'jabatan_id=4')), 'id', 'name'):CHtml::listData(Pegawai::model()->findAll(array('condition'=>'jabatan_id=4')), 'id', 'name'),
              array('prompt'=>isset($model->teknisi_id)?NULL:'Pilih Teknisi',
              )); 
        ?>

	<?php //echo $form->textFieldRow($model,'nomor',array('class'=>'span5','maxlength'=>16)); ?>

	<?php echo $form->textFieldRow($model,'km',array('class'=>'span5','maxlength'=>64)); ?>

	<?php echo $form->textFieldRow($model,'volt',array('class'=>'span5','maxlength'=>16)); ?>

	<?php echo $form->textFieldRow($model,'v_starter',array('class'=>'span5','maxlength'=>16)); ?>

	<?php echo $form->textFieldRow($model,'sistem_kelistrikan',array('class'=>'span5','maxlength'=>16)); ?>

	<?php echo $form->textFieldRow($model,'load_off',array('class'=>'span5','maxlength'=>16)); ?>

	<?php echo $form->textFieldRow($model,'load_on',array('class'=>'span5','maxlength'=>16)); ?>
        
        <?php echo $form->hiddenField($model,'isi_air_aki'); ?>

	<?php echo $form->radioButtonListRow($model,'isi_air_aki', array('0'=>'No', '1'=>'Yes',)); ?>

	<?php echo $form->hiddenField($model,'date_create',array('class'=>'span5', 'value'=>date('Y-m-d'))); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
        
        
        


<script type="text/javascript">
    $(document).ready(function() {
        
        $('#Perawatan_isi_air_aki_1').click(function(){
            $('#Perawatan_isi_air_aki').val('1');
        });
        
        $('#Perawatan_isi_air_aki_0').click(function(){
            $('#Perawatan_isi_air_aki').val('0');
        })
        
    });
</script>