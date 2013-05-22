<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('merk_kendaraan_id')); ?>:</b>
	<?php echo CHtml::encode($data->merk_kendaraan_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kd_kendaraan')); ?>:</b>
	<?php echo CHtml::encode($data->kd_kendaraan); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_create')); ?>:</b>
	<?php echo CHtml::encode($data->date_create); ?>
	<br />


</div>