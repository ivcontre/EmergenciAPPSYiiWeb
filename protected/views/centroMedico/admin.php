<?php
/* @var $this CentroMedicoController */
/* @var $model CentroMedico */

$this->breadcrumbs=array(
	'Administrar Centros Médicos',
);

$this->menu=array(
	//array('label'=>'Listar', 'url'=>array('index')),
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
	$('#centro-medico-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><small>Administrar Centros Médicos </small>
    <a href="<?PHP echo $this->createUrl('create');?>" title="Agrega un nuevo Centro Médico">  
        <img src="<?PHP echo Yii::app()->request->baseUrl."/icons/mas.png";?>">  
    </a>
    <a href="<?PHP echo $this->createUrl('PrintDocument');?>" target="_blank" title="Generar PDF" style="float: right">  
        <img src="<?PHP echo Yii::app()->request->baseUrl."/icons/pdf.png";?>">
    </a>
</h1> 


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
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
                
                //'headerHtmlOptions' => array('class'=>'centro_medico_header'),
	),
));

?>
