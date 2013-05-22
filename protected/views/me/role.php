<?php
/* @var $this UserController */

$this->breadcrumbs=array(
	'Role',
);
?>
<h1>My Account - Password</h1>

<ul class="nav nav-tabs">
  <li>
    <a href="<?php echo Yii::app()->createUrl('me/profile'); ?>">Profile</a>
  </li>
  <li>
      <a href="<?php echo Yii::app()->createUrl('me/password'); ?>">Password</a>
  </li>
  <li  class="active">
      <a href="<?php echo Yii::app()->createUrl('me/role'); ?>">Role</a>
  </li>
</ul>

<?php 
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id'=>'roleForm',
        'type'=>'vertical',
        'enableAjaxValidation'=>false,
        'enableClientValidation'=>true,
        'clientOptions'=>array(
                'validateOnSubmit'=>true,
                'onsubmit'=>"return false"
    ),
)); ?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>
<?php if(Yii::app()->user->hasFlash('passChanged')): ?>
 
<div class="flash-success alert alert-success">
    <?php echo Yii::app()->user->getFlash('passChanged'); ?>
</div>
 
<?php endif; ?>

<?php if(Yii::app()->user->hasFlash('passChangeError')): ?>
 
<div class="alert alert-error">
    <?php echo Yii::app()->user->getFlash('passChangeError'); ?>
</div>
 
<?php endif; ?>

<div class="row" id="result">
<?php echo $form->errorSummary($model); ?>
</div>

<?php $user_id = Yii::app()->user->get()->user->id; ?>
<?php echo $form->dropDownListRow($model,'role_id', CHtml::listData(Role::model()->findAll(array('with'=>'userRole', 'condition'=>"userRole.user_id='$user_id'", 'order' => 't.id')),'id','label'), array('class'=>'span3'));?>
 
<?php //echo $form->passwordFieldRow($model, 'current_password', array('class'=>'span3')); ?>

<?php //echo $form->passwordFieldRow($model, 'new_password', array('class'=>'span3')); ?>
<?php //echo $form->passwordFieldRow($model, 'repeat_new_password', array('class'=>'span3')); ?>


<br />
<?php //echo $form->checkboxRow($model, 'checkbox'); ?>
<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'label'=>'Save')); ?>


 
<?php $this->endWidget(); ?>
