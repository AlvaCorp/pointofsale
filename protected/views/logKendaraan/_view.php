<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('modifikasi_id')); ?>:</b>
	<?php echo CHtml::encode($data->modifikasi_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('masalah_id')); ?>:</b>
	<?php echo CHtml::encode($data->masalah_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('beban_id')); ?>:</b>
	<?php echo CHtml::encode($data->beban_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('teknisi_id')); ?>:</b>
	<?php echo CHtml::encode($data->teknisi_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('detail_kendaraan_id')); ?>:</b>
	<?php echo CHtml::encode($data->detail_kendaraan_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kondisi_id')); ?>:</b>
	<?php echo CHtml::encode($data->kondisi_id); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('date')); ?>:</b>
	<?php echo CHtml::encode($data->date); ?>
	<br />

	*/ ?>

</div>