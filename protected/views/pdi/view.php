<?php
/* @var $this PdiController */
/* @var $model PDI */

$this->breadcrumbs=array(
	'Pdis'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List PDI', 'url'=>array('index')),
	array('label'=>'Create PDI', 'url'=>array('create')),
	array('label'=>'Update PDI', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete PDI', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage PDI', 'url'=>array('admin')),
);
?>

<h1>Detalle PDI ID: <?php echo $model->id; ?></h1>

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
