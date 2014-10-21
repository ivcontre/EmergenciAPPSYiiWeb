<?php
/* @var $this BomberoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Bomberos',
);
$baseUrl = Yii::app()->baseUrl; 
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile($baseUrl.'/js/user/actionBombero.js');

?>

<h1>Buscar por Comuna</h1>

<div class="row">
		
                <?php
                    
                   
                    
                    
                    $this->widget('zii.widgets.jui.CJuiAutoComplete', array (
                        'name' => 'comuna',
                        //'model' => $model,
                        //'value' => $value,
                        'sourceUrl' => $this->createUrl('ListarComunas'),
                        'options' => array(
                                    'minLength' => '2',
                                    'showAnim' => 'fold',
                                    'select' => 'js:function(event, ui) {$("#id_comuna").val(ui.item["nombre"]); '
                            . 'actionBombero.cargarMapa();}',
                            
                                   
                        ),
                    ));
                     
                     
                ?>
		
</div>
<div class="row">
       <div id="map" style="width:100%; height:600px"></div>
</div>

<?php echo "<script>actionBombero.cargarMapa();</script>";?>