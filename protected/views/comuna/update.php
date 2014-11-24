<?php
/* @var $this ComunaController */
/* @var $model Comuna */

$this->breadcrumbs=array(
	'Comunas'=>array('index'),
	$model->nombre=>array('view','id'=>$model->id_comuna),
	'Editar',
);

$this->menu=array(
	array('label'=>'Ingresar nuevo', 'url'=>array('create')),
	array('label'=>'Detalle', 'url'=>array('view', 'id'=>$model->id_comuna)),
	array('label'=>'Administrar', 'url'=>array('admin')),
    array('label'=>'Eliminar', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'¿Estás seguro que deseas eliminar esta comuna?')),
);
?>

<h2 class="white">Editar <small><?php echo $model->nombre;?></small></h2>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>