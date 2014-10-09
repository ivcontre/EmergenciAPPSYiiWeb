<?php
/* @var $this CarabineroController */
/* @var $model Carabinero */

$this->breadcrumbs=array(
	'Carabineros'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Carabinero', 'url'=>array('index')),
	array('label'=>'Create Carabinero', 'url'=>array('create')),
	array('label'=>'Update Carabinero', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Carabinero', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Carabinero', 'url'=>array('admin')),
);
?>

<h1>Detalle Carabineros ID: <?php echo $model->id; ?></h1>

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
