<?php
/* @var $this BomberoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Carabineros',
);
$baseUrl = Yii::app()->baseUrl; 
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile($baseUrl.'/js/user/actionCarabinero.js');

Yii::app()->clientScript->registerScript('helpers', '                                                           
          yii = {                                                                                                     
              urls: {                                                                                                 
                  cercanos: '.CJSON::encode(Yii::app()->createUrl('api/cercanos')).',                                   
                  base: '.CJSON::encode(Yii::app()->baseUrl).'                                                        
              }                                                                                                       
          };                                                                                                          
      ');  

?>

<h1>Buscar por Comuna</h1>
<div id="container">
    

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
                            . 'actionCarabinero.initializeMapCarabinerosPorComuna(ui.item["nombre"]);}',
                            
                                   
                        ),
                    ));
                     
                     
                ?>
		
</div>
<div class="row">
       <div id="map" style="width:100%; height:600px"></div>
</div>
    
    </div>

<?php echo "<script>actionCarabinero.cargarMapa();</script>";?>