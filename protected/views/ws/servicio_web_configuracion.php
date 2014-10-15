<?php

    $numero_telefono = $_POST['numero_telefono'];
    $numero_carabinero = $_POST['numero_carabinero'];
    $numero_bombero = $_POST['numero_bombero'];  
    $numero_centro_medico = $_POST['numero_centro_medico'];
    $radio_busqueda =  $_POST['radio_busqueda'];
    $mensaje_alerta =  $_POST['mensaje_alerta'];
    
    $link = mysql_connect("localhost","rhormaza","czeSCfCQ");
    mysql_select_db("rhormaza",$link);
    
    $consulta = "UPDATE configuracion SET  numero_carabinero = '".$numero_carabinero."', numero_bombero ='".$numero_bombero."', numero_centro_medico = '".$numero_centro_medico."', radio_busqueda = ".$radio_busqueda.", mensaje_alerta = '".$mensaje_alerta."', fecha_modificacion = sysdate() WHERE numero_usuario = '".$numero_telefono."';";
            
    
    mysql_query($consulta,$link) or die("false");
    mysql_close($link);

    echo "true";
    

?>