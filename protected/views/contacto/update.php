<?php
/* @var $this ContactoController */
/* @var $model Contacto */
?>

<?php
$this->breadcrumbs=array(
	'Contactos'=>array('admin'),
	$model->nombre=>array('view','id'=>$model->id_contacto),
	'Editar',
);

$this->menu=array(
	array('label'=>'Agregar nuevo', 'url'=>array('create')),
	array('label'=>'Ver Contacto', 'url'=>array('view', 'id'=>$model->id_contacto)),
	array('label'=>'Ver Todos', 'url'=>array('admin')),
);
?>

    <h1>Update Contacto <?php echo $model->id_contacto; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>