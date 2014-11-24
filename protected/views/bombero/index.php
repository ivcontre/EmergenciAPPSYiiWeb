<?php
/* @var $this BomberoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Bomberos',
);
$baseUrl = Yii::app()->baseUrl; 
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile($baseUrl.'/js/user/actionBombero.js');

Yii::app()->clientScript->registerScript('helpers', '                                                           
          yii = {                                                                                                     
              urls: {                                                                                                 
                  cercanos: '.CJSON::encode(Yii::app()->createUrl('api/cercanos')).',                                   
                  base: '.CJSON::encode(Yii::app()->baseUrl).'                                                        
              }                                                                                                       
          };                                                                                                          
      ');  

?>

<div id="container">
    <h1><small>Busca por Comuna</small></h1>   

		
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
                            . 'actionBombero.initializeMapBomberosPorComuna(ui.item["nombre"]);}',
                            
                                   
                        ),
                    ));
                     
                     
                ?>
		

       <div id="map" style="width:100%; height:600px"></div>
       <?PHP
echo '<div class="brillo">';
    echo '</div>';
    echo '<div class="brillo2">';
   //echo TbHtml::button('Descargar', array('color' =>TbHtml::BUTTON_COLOR_PRIMARY, 'size' => TbHtml::BUTTON_SIZE_LARGE));
    echo '</div>';
?>
    
    </div>

<?php echo "<script>actionBombero.cargarMapa();</script>";?>