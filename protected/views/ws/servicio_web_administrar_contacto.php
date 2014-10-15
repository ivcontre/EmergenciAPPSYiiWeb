<?php
    if(isset($_POST['numero_telefono'])){
       $numero_telefono = $_POST['numero_telefono']; 
    }
    if(isset($_POST['nombre'])){
        $nombre = $_POST['nombre'];
    }
    if(isset($_POST['numero'])){
        $numero = $_POST['numero'];
    }
    if(isset($_POST['correo'])){
        $correo = $_POST['correo'];
    }
    if(isset($_POST['alerta_sms'])){
        $alerta_sms = $_POST['alerta_sms'];
    }
    if(isset($_POST['alerta_gps'])){
        $alerta_gps = $_POST['alerta_gps'];
    }
    if(isset($_POST['alerta_correo'])){
        $alerta_correo = $_POST['alerta_correo'];
    }
    
    $link = mysql_connect("localhost","rhormaza","czeSCfCQ");
    mysql_select_db("rhormaza",$link);
    
    if($_POST['id_contacto'] == -1){ // Se ingresa contacto nuevo
        
        $resultado_max = mysql_query("SELECT MAX(id_contacto) FROM contacto", $link);
        $row = mysql_fetch_row($resultado_max);
        
        $highest_id = $row[0];
       
       if($highest_id != 0){
           $id = $highest_id+1;
       }else{
           $id = 1;
       }
       $estado = 0;
       $consulta = "INSERT INTO contacto (id_contacto, numero_telefono, nombre, numero, correo, estado, alerta_sms, alerta_gps, alerta_correo) VALUES (".$id.",'".$numero_telefono."', '".$nombre."', '".$numero."', '".$correo."', ".$estado.", ".$alerta_sms.", ".$alerta_gps.", ".$alerta_correo.");";
       $resultado = mysql_query($consulta,$link);
       if($resultado){
           echo "true";
       }else{
           echo "false";
       }
       mysql_close($link);
      
    }else{ // Se elimina un contacto
        if(!isset($_POST['numero_telefono']) && !isset($_POST['numero']) && !isset($_POST['nombre']) && !isset($_POST['correo'])){
            $id_contacto = $_POST['id_contacto'];
            $consulta = "DELETE FROM contacto WHERE id_contacto = ".$id_contacto.";";
            $resultado = mysql_query($consulta,$link);
            if($resultado){
                echo "true";
            }else{
                echo "false";
            }
            mysql_close($link);
           
        }else{ // Se actualiza un contacto
            $id_contacto = $_POST['id_contacto'];
            $estado = $_POST['estado'];
            $consulta = "UPDATE contacto SET numero_telefono = '".$numero_telefono."', nombre = '".$nombre."', numero = '".$numero."', correo = '".$correo."', estado = ".$estado.", alerta_sms = ".$alerta_sms.", alerta_gps = ".$alerta_gps.", alerta_correo = ".$alerta_correo." WHERE id_contacto = ".$id_contacto.";";
            $resultado = mysql_query($consulta,$link);
            if($resultado){
                echo "true";
            }else{
                echo "false";
            }
            mysql_close($link);
        }
    }
    
        
    
    
    
   

?>