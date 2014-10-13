<?php
/* @var $this CarabineroController */
/* @var $model Carabinero */

$this->breadcrumbs=array(
	'Carabineros'=>array('index'),
	$model->nombre,
);

$this->menu=array(
	array('label'=>'Listar Carabineros', 'url'=>array('index')),
	array('label'=>'Crear nuevo', 'url'=>array('create')),
	array('label'=>'Actualizar Carabinero', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Eliminar Carabinero', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Administrar Carabineros', 'url'=>array('admin')),
);
?>

<?php echo TbHtml::pageHeader('Detalle Carabinero', $model->nombre); ?>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'nombre',
		'direccion',
		'idComuna.nombre',
                'x',
		'y',
		'telefono',
	),
)); 
?>
<div id="map_detalle" style="width: 100%; height:350px"></div>
<?php
 echo "<script>initializeconcoordenadas(".$model->x.",".$model->y.");</script>";
?>
