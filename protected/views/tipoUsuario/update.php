<?php
/* @var $this TipoUsuarioController */
/* @var $model TipoUsuario */

$this->breadcrumbs=array(
	'Tipo Usuarios'=>array('index'),
	$model->id_tipo_usuario=>array('view','id'=>$model->id_tipo_usuario),
	'Update',
);

$this->menu=array(
	array('label'=>'List TipoUsuario', 'url'=>array('index')),
	array('label'=>'Create TipoUsuario', 'url'=>array('create')),
	array('label'=>'View TipoUsuario', 'url'=>array('view', 'id'=>$model->id_tipo_usuario)),
	array('label'=>'Manage TipoUsuario', 'url'=>array('admin')),
);
?>

<h1>Update TipoUsuario <?php echo $model->id_tipo_usuario; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>