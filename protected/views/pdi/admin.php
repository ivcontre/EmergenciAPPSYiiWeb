<?php
/* @var $this PdiController */
/* @var $model PDI */

$this->breadcrumbs=array(
	'Administrar PDI',
);

$this->menu=array(
	array('label'=>'Ingresar Nuevo', 'url'=>array('create')),
     TbHtml::menuDivider(),
        array('label'=>'Generar Reporte', 'url'=>array('PrintDocument')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#pdi-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Administrar Policía de Investigaciones</h1>

<?php 
$this->widget('bootstrap.widgets.TbGridView', array(
   'dataProvider' => $model->search(),
   'filter' => $model,
   'type' => TbHtml::GRID_TYPE_HOVER,
   'columns'=>array(
		'id',
		'nombre',
		'direccion',
		array(
                    'value' => '$data->idComuna->nombre',
                    'name' => 'id_comuna'
                ),
		'telefono',
		
		array(
			'class'=>'CButtonColumn',
		),
	),
));

?>
