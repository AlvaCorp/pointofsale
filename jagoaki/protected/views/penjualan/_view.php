<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('penjualan_id')); ?>:</b>
	<?php echo CHtml::encode($data->penjualan_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_role_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_role_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('log_kendaraan_id')); ?>:</b>
	<?php echo CHtml::encode($data->log_kendaraan_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('customer_id')); ?>:</b>
	<?php echo CHtml::encode($data->customer_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kd_penjualan')); ?>:</b>
	<?php echo CHtml::encode($data->kd_penjualan); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date')); ?>:</b>
	<?php echo CHtml::encode($data->date); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('total')); ?>:</b>
	<?php echo CHtml::encode($data->total); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bayar')); ?>:</b>
	<?php echo CHtml::encode($data->bayar); ?>
	<br />

	*/ ?>

</div>