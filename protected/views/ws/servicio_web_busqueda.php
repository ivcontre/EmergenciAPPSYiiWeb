<?php
	$tabla = $_POST['tabla'];
        $comuna = $_POST['comuna'];

	$link = mysql_connect("localhost","rhormaza","czeSCfCQ");
	mysql_select_db("rhormaza",$link);
        
	
	$laConsulta = 	"SELECT id, t.nombre as t_nombre, x, y, direccion, telefono
					FROM ".$tabla." as t, comuna 
					WHERE t.id_comuna = comuna.id_comuna 
					AND comuna.nombre ='".$comuna."' ;";
					
	$resultado = mysql_query($laConsulta,$link);
	mysql_close($link);
	$filas = array();
        
        while ($row = mysql_fetch_array($resultado)){
	   $columna = array();
	   $columna['id'] = $row['id'];
	   $columna['nombre'] = utf8_encode($row['t_nombre']);
	   $columna['lat'] = $row['x'];
	   $columna['lng'] = $row['y'];
	   $columna['direccion'] = utf8_encode( $row['direccion']);
	   $columna['telefono'] =$row['telefono'] ;
           
	   
	   
	   $filas[] = $columna;
	}   
	
	
	$total = array();
        
	$total[$tabla] = $filas;
	echo json_encode($total);
	

?>