<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<?php echo $form->textFieldRow($model,'id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'merk_kendaraan_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'jenis_kendaraan_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'kategori_kendaraan_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'bahan_bakar_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'no_kendaraan',array('class'=>'span5','maxlength'=>16)); ?>

	<?php echo $form->textFieldRow($model,'no_mesin',array('class'=>'span5','maxlength'=>128)); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType' => 'submit',
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
