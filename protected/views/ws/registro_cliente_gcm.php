<?php

if(isset($_POST['id_contacto'])){
       $numero_telefono = $_POST['id_contacto']; 
}

if(isset($_POST['regedit'])){
       $regedit = $_POST['regedit']; 
}

$link = mysql_connect("localhost","rhormaza","czeSCfCQ");
mysql_select_db("rhormaza",$link);

$consulta = "UPDATE usuario SET regedit = '".$regedit."' WHERE numero_telefono = '".$numero_telefono."';";

mysql_query($consulta,$link) or die("false");

echo "true";
?>
