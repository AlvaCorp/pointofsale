<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('merk_kendaraan_id')); ?>:</b>
	<?php echo CHtml::encode($data->merk_kendaraan_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('jenis_kendaraan_id')); ?>:</b>
	<?php echo CHtml::encode($data->jenis_kendaraan_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kategori_kendaraan_id')); ?>:</b>
	<?php echo CHtml::encode($data->kategori_kendaraan_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bahan_bakar_id')); ?>:</b>
	<?php echo CHtml::encode($data->bahan_bakar_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('no_kendaraan')); ?>:</b>
	<?php echo CHtml::encode($data->no_kendaraan); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('no_mesin')); ?>:</b>
	<?php echo CHtml::encode($data->no_mesin); ?>
	<br />


</div>