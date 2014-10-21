<?php
/* @var $this BomberoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Bomberos',
);

?>

<h1>Bomberos</h1>

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
		'telefono',
		array(
			'class'=>'CButtonColumn',
                        'deleteButtonImageUrl'=>false,
                        'updateButtonImageUrl'=>false,
                        'viewButtonImageUrl'=>false,
                        'template'=>'{view}',
                        'buttons' => array(
                            'view'=>array(
                                    
                                    'url'=>'Yii::app()->createUrl("bombero/view", array("id"=>$data->id))',
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
