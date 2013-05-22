<?php
$this->breadcrumbs=array(
	'User Roles',
);

$this->menu=array(
	array('label'=>'Create UserRole','url'=>array('create')),
	array('label'=>'Manage UserRole','url'=>array('admin')),
);
?>

<h1>User Roles</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
