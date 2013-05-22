<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<?php echo $form->textFieldRow($model,'id',array('class'=>'span5')); ?>

	<?php //echo $form->textFieldRow($model,'gerai_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'product_category_id',array('class'=>'span5')); ?>

	<?php //echo $form->textFieldRow($model,'merk_product_id',array('class'=>'span5')); ?>

	<?php //echo $form->textFieldRow($model,'kd_product',array('class'=>'span5','maxlength'=>128)); ?>

	<?php //echo $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>256)); ?>

	<?php //echo $form->textFieldRow($model,'tanggal_produksi',array('class'=>'span5')); ?>

	<?php //echo $form->textFieldRow($model,'no_produksi',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'harga',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'diskon',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'jumlah',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'kendaraan',array('class'=>'span5','maxlength'=>64)); ?>

	<?php echo $form->textFieldRow($model,'garansi_max',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType' => 'submit',
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
