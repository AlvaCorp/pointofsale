<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<?php echo $form->textFieldRow($model,'id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'parent_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'user_role_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'log_kendaraan_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'customer_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'kd_penjualan',array('class'=>'span5','maxlength'=>256)); ?>

	<?php echo $form->textFieldRow($model,'date',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'total',array('class'=>'span5','maxlength'=>32)); ?>

	<?php echo $form->textFieldRow($model,'bayar',array('class'=>'span5','maxlength'=>32)); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType' => 'submit',
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
