<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'product-form',
        'type'=>'horizontal',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
        
        <?php //echo $form->hiddenField($model,'gerai_id',array('class'=>'span5', 'value'=>Yii::app()->user->get()->user->gerai_id)); ?>
        
        <?php 
            /*
                echo $form->dropDownListRow($model, 'gerai_id', isset($model->terms_id)?CHtml::listData(Gerai::model()->findAll(), 'id', 'name'):CHtml::listData(Gerai::model()->findAll(), 'id', 'name'),
                array('prompt'=>isset($model->gerai_id)?NULL:'Pilih Gerai',
                )); 
             * 
             */
        ?>

        <?php echo $form->dropDownListRow($model, 'product_category_id', isset($model->product_category_id)?CHtml::listData(ProductCategory::model()->findAll(), 'id', 'name'):CHtml::listData(ProductCategory::model()->findAll(), 'id', 'name'),
                array('prompt'=>isset($model->product_category_id)?NULL:'Pilih Kategori Produk',
                )); 
        ?>
        


        <?php echo $form->dropDownListRow($model, 'merk_product_id', isset($model->merk_product_id)?CHtml::listData(MerkProduct::model()->findAll(), 'id', 'name'):CHtml::listData(MerkProduct::model()->findAll(), 'id', 'name'),
                array('prompt'=>isset($model->merk_product_id)?NULL:'Pilih Merk Produk',
                )); 
        ?>
        
        <?php echo $form->dropDownListRow($model, 'product_type_id', isset($model->product_type_id)?CHtml::listData(ProductType::model()->findAll(), 'id', 'name'):CHtml::listData(ProductType::model()->findAll(), 'id', 'name'),
                array('prompt'=>isset($model->product_type_id)?NULL:'Pilih Tipe Produk',
                )); 
        ?>

	<?php echo $form->textFieldRow($model,'kd_product',array('class'=>'span5','maxlength'=>128)); ?>

	<?php echo $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>256)); ?>

        <?php //echo $form->datepickerRow($model, 'tanggal_produksi',
              //array('hint'=>'Click inside! This is a super cool date field.', 'format'=>'dd-mm-yyyy',
              //'prepend'=>'<i class="icon-calendar"></i>')); 
        ?>

	<?php //echo $form->textFieldRow($model,'no_produksi',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'harga',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'diskon',array('class'=>'span5')); ?>

	<?php //echo $form->textFieldRow($model,'jumlah',array('class'=>'span5')); ?>

	<?php //echo $form->textFieldRow($model,'kendaraan',array('class'=>'span5','maxlength'=>64)); ?>

	<?php echo $form->textFieldRow($model,'garansi_max',array('class'=>'span5')); ?>
        
        <?php echo $form->dropDownListRow($model, 'product_satuan_id', isset($model->product_satuan_id)?CHtml::listData(ProductSatuan::model()->findAll(), 'id', 'name'):CHtml::listData(ProductSatuan::model()->findAll(), 'id', 'name'),
                array('prompt'=>isset($model->product_satuan_id)?NULL:'Pilih Satuan',
                )); 
        ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
