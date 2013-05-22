<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<?php echo $form->textFieldRow($model,'id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'detail_kendaraan_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'teknisi_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'nomor',array('class'=>'span5','maxlength'=>16)); ?>

	<?php echo $form->textFieldRow($model,'km',array('class'=>'span5','maxlength'=>64)); ?>

	<?php echo $form->textFieldRow($model,'volt',array('class'=>'span5','maxlength'=>16)); ?>

	<?php echo $form->textFieldRow($model,'v_starter',array('class'=>'span5','maxlength'=>16)); ?>

	<?php echo $form->textFieldRow($model,'sistem_kelistrikan',array('class'=>'span5','maxlength'=>16)); ?>

	<?php echo $form->textFieldRow($model,'load_off',array('class'=>'span5','maxlength'=>16)); ?>

	<?php echo $form->textFieldRow($model,'load_on',array('class'=>'span5','maxlength'=>16)); ?>

	<?php echo $form->textFieldRow($model,'isi_air_aki',array('class'=>'span5','maxlength'=>16)); ?>

	<?php echo $form->textFieldRow($model,'date_create',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType' => 'submit',
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
