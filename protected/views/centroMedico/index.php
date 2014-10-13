<?php
/* @var $this CentroMedicoController */
/* @var $dataProvider CActiveDataProvider */

//$this->breadcrumbs=array(
//	'Centro Medicos',
//);

echo TbHtml::breadcrumbs(array(
    'Home' => array('index'),
    'Centros Médicos',
));

$this->menu=array(
	array('label'=>'Crear Centro Médico', 'url'=>array('create')),
	array('label'=>'Administrar Centro Médico', 'url'=>array('admin')),
);
?>

<h1>Centros Medicos</h1>

<?php 
//$this->widget('zii.widgets.CListView', array(
//	'dataProvider'=>$dataProvider,
//	'itemView'=>'_view',
//)); 

$this->widget('bootstrap.widgets.TbGridView', array(
        'type' => TbHtml::GRID_TYPE_HOVER,
        'dataProvider'=>$dataProvider,
        'columns'=>array(
		'id',
		'nombre',
		'direccion',
		array(
                    'value' => '$data->idComuna->nombre',
                    'name' => 'id_comuna'
                ),
		
		'x',
		
		'y',
		'telefono',
		array(
			'class'=>'CButtonColumn',
                        'deleteButtonImageUrl'=>false,
                        'updateButtonImageUrl'=>false,
                        'viewButtonImageUrl'=>false,
                        'template'=>'{view}',
                        'buttons' => array(
                            'view'=>array(
                                    
                                    'url'=>'Yii::app()->createUrl("centroMedico/view", array("id"=>$data->id))',
                                    'label'=>' ',
                                    'options'=>array(
                                        'class'=>TbHtml::ICON_SEARCH
                                    ), // HTML options for the button tag
                               
                            ),
                            ),
		),
	),
    ));


?>
