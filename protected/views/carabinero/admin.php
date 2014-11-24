<?php
/* @var $this CarabineroController */
/* @var $model Carabinero */

$this->breadcrumbs=array(
	'Administrar Carabineros',
);

$this->menu=array(
	//array('label'=>'Listar Carabineros', 'url'=>array('index')),
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
	$('#carabinero-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><small>Administrar Retenes de Carabinero </small>
    <a href="<?PHP echo $this->createUrl('create');?>" title="Agrega un nuevo Centro Médico">  
        <img src="<?PHP echo Yii::app()->request->baseUrl."/icons/mas.png";?>">  
    </a>
    <a href="<?PHP echo $this->createUrl('PrintDocument');?>" target="_blank" title="Generar PDF">  
        <img src="<?PHP echo Yii::app()->request->baseUrl."/icons/pdf.png";?>">
    </a>
</h1> 
<?php // $this->widget('zii.widgets.grid.CGridView', array(
//	'id'=>'carabinero-grid',
//	'dataProvider'=>$model->search(),
//	'filter'=>$model,
//	'columns'=>array(
//		'id',
//		'nombre',
//		'direccion',
//		array(
//                    'value' => '$data->idComuna->nombre',
//                    'name' => 'id_comuna'
//                ),
//		
//		'x',
//		
//		'y',
//		'telefono',
//		array(
//			'class'=>'CButtonColumn',
//		),
//	),
//)); 
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
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
));

?>
