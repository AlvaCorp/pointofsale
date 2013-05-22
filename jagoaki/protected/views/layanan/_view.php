<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('detail_kendaraan_id')); ?>:</b>
	<?php echo CHtml::encode($data->detail_kendaraan_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('teknisi_id')); ?>:</b>
	<?php echo CHtml::encode($data->teknisi_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nomor')); ?>:</b>
	<?php echo CHtml::encode($data->nomor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('km')); ?>:</b>
	<?php echo CHtml::encode($data->km); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('volt')); ?>:</b>
	<?php echo CHtml::encode($data->volt); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('v_starter')); ?>:</b>
	<?php echo CHtml::encode($data->v_starter); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('sistem_kelistrikan')); ?>:</b>
	<?php echo CHtml::encode($data->sistem_kelistrikan); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('load_off')); ?>:</b>
	<?php echo CHtml::encode($data->load_off); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('load_on')); ?>:</b>
	<?php echo CHtml::encode($data->load_on); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('isi_air_aki')); ?>:</b>
	<?php echo CHtml::encode($data->isi_air_aki); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_create')); ?>:</b>
	<?php echo CHtml::encode($data->date_create); ?>
	<br />

	*/ ?>

</div>