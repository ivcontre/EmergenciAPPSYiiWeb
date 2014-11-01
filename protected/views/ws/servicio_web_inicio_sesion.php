<?php

    $telefono = $_POST['telefono'];
    $password = $_POST['password'];
    
    $link = mysql_connect("localhost","rhormaza","czeSCfCQ");
    mysql_select_db("rhormaza",$link);
    
    $consulta = "SELECT * FROM usuario WHERE numero_telefono = '".$telefono."' AND password = '".$password."' ;";
    $resultado = mysql_query($consulta,$link);
    $numero_filas = mysql_num_rows($resultado);
    
    
    if($numero_filas > 0){
       $usuario = Array();
       while($row = mysql_fetch_array($resultado)){
           $usuario['numero'] = $row['numero_telefono'];
           $usuario['nombre'] = $row['nombre'];
           $usuario['apellido'] = $row['apellido'];
           $usuario['correo'] = $row['correo'];
           $usuario['estadoAlerta'] = $row['estado_alerta'];
       }
       
       $consulta = "SELECT * FROM contacto WHERE numero_telefono = '".$telefono."' ORDER BY nombre ASC ;";
       $resultado_contactos = mysql_query($consulta,$link);
       $contactos = Array();
       while($row = mysql_fetch_array($resultado_contactos)){
           $contacto['_id'] = $row['id_contacto'];
           $contacto['nombre'] = utf8_encode($row['nombre']);
           $contacto['numero_telefono'] = $row['numero_telefono'];
           $contacto['numero'] = $row['numero'];
           $contacto['correo'] = $row['correo'];
           $contacto['alerta_sms'] = $row['alerta_sms'];
           $contacto['alerta_gps'] = $row['alerta_gps'];
           $contacto['alerta_correo'] = $row['alerta_correo'];
           $contactos[] = $contacto;
       }
       $usuario['contactos'] = $contactos;
       
       
       $consulta = "SELECT * FROM configuracion WHERE numero_usuario = '".$telefono."'  ;";
       
       $resultado_configuracion = mysql_query($consulta,$link);
       $configuracion = Array();
       while($row = mysql_fetch_array($resultado_configuracion)){
           $configuracion['id_configuracion'] = $row['id_configuracion'];
           $configuracion['numero_pdi'] = $row['numero_pdi'];
           $configuracion['numero_bombero'] = $row['numero_bombero'];
           $configuracion['numero_centro_medico'] = $row['numero_centro_medico'];
           $configuracion['numero_carabinero'] = $row['numero_carabinero'];
           $configuracion['radio_busqueda'] = $row['radio_busqueda'];
           $configuracion['mensaje_alerta'] = $row['mensaje_alerta'];
           $configuracion['fecha_modificacion'] = $row['fecha_modificacion'];
       }
       $usuario['configuracion'] = $configuracion;
       
       
       echo json_encode($usuario);
       
       
    }else{
        
    }
    mysql_close($link);
    
?>
