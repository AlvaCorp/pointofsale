<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'penjualan-form',
        'type'=>'horizontal',
        'enableAjaxValidation'=>false,
        'enableClientValidation'=>true,
        'clientOptions'=>array(
                'validateOnSubmit'=>true,
        ),
        'htmlOptions'=>array('class'=>'well')
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
                
        <!-- Form Penjualan -->
        <fieldset>
            <legend>Cancel Penjualan / Invoice</legend>

	<?php echo $form->textFieldRow($model,'kd_penjualan',array('class'=>'span5','maxlength'=>256)); ?>
        <!-- End Of Penjualan -->
        </fieldset>


	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$penjualan->isNewRecord ? 'Submit' : 'Submit',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
