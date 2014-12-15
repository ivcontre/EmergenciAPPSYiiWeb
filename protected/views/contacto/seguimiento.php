<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * Metodo para acceder a buttodropdown
 * $("div.btn-group .dropdown-menu").append("<li role='menuitem'><a tabindex='-1' href='#'>holas4</a></li>");
 * $("div.btn-group .dropdown-menu").
 * $("div.btn-group .dropdown-menu").empty(); limpiar
 * 
 * $("a.btn.btn-warning.dropdown-toggle").empty(); eliminar texto boton
 * $("a.btn.btn-warning.dropdown-toggle").append("No existen usuarios<b class='caret'></b>"); agregar texto
 */

$baseUrl = Yii::app()->baseUrl; 
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile($baseUrl.'/js/user/actionSeguimiento.js');

Yii::app()->clientScript->registerScript('helpers', '                                                           
          yii = {                                                                                                     
              urls: {                                                                                                 
                  alertas: '.CJSON::encode(Yii::app()->createUrl('api/alertas')).',                                   
                  base: '.CJSON::encode(Yii::app()->baseUrl).'                                                        
              }                                                                                                       
          };                                                                                                          
      ');  
$alertas = $this->alertas();
echo "<div class='contenedor_dropdown'>";
echo TbHtml::buttonDropdown($alertas['title'],$alertas['labels'],$alertas['htmlOptions'] 
        
);
echo "</div>";
?>
<br></br>
 <div id="map" style="width:100%; height:600px"></div>
 
 <?php echo "<script>actionSeguimiento.cargarMapa();</script>";?>
