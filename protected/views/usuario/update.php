<?php
/* @var $this UsuarioController */
/* @var $model Usuario */

$this->breadcrumbs=array(
	'Perfil'=>array('usuario/view&id='.$model->numero_telefono),
	'Editar',
);

$this->menu=array(
	array('label'=>'Perfil', 'url'=>array('view', 'id'=>$model->numero_telefono)),
);
?>

<h1>Mi cuenta</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>