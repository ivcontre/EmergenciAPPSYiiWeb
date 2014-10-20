<?php
/* @var $this BomberoController */
/* @var $model Bombero */

$this->breadcrumbs=array(
	'Bomberos'=>array('index'),
	$model->nombre,
);

$this->menu=array(
	array('label'=>'Listar', 'url'=>array('index')),
	array('label'=>'Ingresar nuevo', 'url'=>array('create')),
	array('label'=>'Editar', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Eliminar', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Administrar', 'url'=>array('admin')),
);
?>

<h1>Detalle Bomberos ID: <?php echo $model->id; ?></h1>

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
