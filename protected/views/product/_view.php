<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php //echo CHtml::encode($data->getAttributeLabel('gerai_id')); ?>:</b>
	<?php //echo CHtml::encode($data->gerai_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('product_category_id')); ?>:</b>
	<?php echo CHtml::encode($data->product_category_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('merk_product_id')); ?>:</b>
	<?php echo CHtml::encode($data->merk_product_id); ?>
	<br />

	<b><?php //echo CHtml::encode($data->getAttributeLabel('kd_product')); ?>:</b>
	<?php //echo CHtml::encode($data->kd_product); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tanggal_produksi')); ?>:</b>
	<?php echo CHtml::encode($data->tanggal_produksi); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('no_produksi')); ?>:</b>
	<?php echo CHtml::encode($data->no_produksi); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('harga')); ?>:</b>
	<?php echo CHtml::encode($data->harga); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('diskon')); ?>:</b>
	<?php echo CHtml::encode($data->diskon); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('jumlah')); ?>:</b>
	<?php echo CHtml::encode($data->jumlah); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kendaraan')); ?>:</b>
	<?php echo CHtml::encode($data->kendaraan); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('garansi_max')); ?>:</b>
	<?php echo CHtml::encode($data->garansi_max); ?>
	<br />

	*/ ?>

</div>