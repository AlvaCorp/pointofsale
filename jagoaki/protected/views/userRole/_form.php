<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'user-role-form',
        'type'=>'horizontal',
        'enableAjaxValidation'=>false,
        'enableClientValidation'=>true,
        'clientOptions'=>array(
                'validateOnSubmit'=>true,
        ),
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
        
        <?php if(Yii::app()->user->hasFlash('Error')): ?>

        <div class="alert alert-error">
            <?php echo Yii::app()->user->getFlash('Error'); ?>
        </div>

        <?php endif; ?>

	<?php //echo $form->textFieldRow($model,'role_id',array('class'=>'span5')); ?>
        <?php echo $form->dropDownListRow($model, 'role_id', isset($model->role_id)?CHtml::listData(Role::model()->findAll(), 'id', 'label'):CHtml::listData(Role::model()->findAll(), 'id', 'label'),
                array('prompt'=>isset($model->role_id)?NULL:'Pilih Role',
                )); 
        ?>
        
        <?php echo $form->dropDownListRow($model, 'user_id', isset($model->user_id)?CHtml::listData(User::model()->findAll(), 'id', 'name'):CHtml::listData(User::model()->findAll(), 'id', 'name'),
                array('prompt'=>isset($model->user_id)?NULL:'Pilih User',
                )); 
        ?>

	<?php //echo $form->textFieldRow($model,'user_id',array('class'=>'span5')); ?>

	<?php //echo $form->textFieldRow($model,'status',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
