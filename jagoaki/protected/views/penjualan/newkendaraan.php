	<div id="FormNewKendaraan">
	<fieldset>
		<legend>
			Form Kendaraan Baru
		</legend>
					
					<?php
						$newKendaraan = new Kendaraan;
						
						echo $form->dropDownListRow($newKendaraan, 'jenis_kendaraan_id', isset($newKendaraan->jenis_kendaraan_id)?CHtml::listData(JenisKendaraan::model()->findAll(), 'id', 'name'):CHtml::listData(JenisKendaraan::model()->findAll(), 'id', 'name'),
								array('prompt'=>isset($newKendaraan->jenis_kendaraan_id)?NULL:'Jenis Kendaraan',
                        )); 
						
						echo $form->dropDownListRow($newKendaraan, 'merk_kendaraan_id', isset($newKendaraan->merk_kendaraan_id)?CHtml::listData(MerkKendaraan::model()->findAll(), 'id', 'name'):CHtml::listData(MerkKendaraan::model()->findAll(), 'id', 'name'),
								array('prompt'=>isset($newKendaraan->merk_kendaraan_id)?NULL:'Pilih Merk Kendaraan',
                        )); 
                    ?>
					<?php
						echo $form->textFieldRow($newKendaraan, 'tahun_kendaraan', array('class'=>'span5'));
					?>					
					<?php
						echo $form->textFieldRow($newKendaraan, 'no_mesin', array('class'=>'span5'));
					?>
					
					<?php
						$newDetailKendaraan = new DetailKendaraan;
						echo $form->textFieldRow($newDetailKendaraan, 'nopol', array('class'=>'span5'));
					?>
					
					<?php
						echo $form->hiddenField($newDetailKendaraan, 'customer_id', array('class'=>'span5', 'value'=>$customer->id));
					?>

                    <?php echo $form->hiddenField($logKendaraan,'date',array('value'=>date('Y-m-d'))); ?>
            </fieldset>
        </div>