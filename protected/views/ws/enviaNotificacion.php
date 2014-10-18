<?php

include "GCMPushMessage.php";
echo "hola 1";
$numero_usuario = $_GET['id_contacto'];

$usCon = new UsuarioController($id);
$model=$usCon->loadModel($id);
echo $model->nombre;
echo "hola";
$apiKey = "AIzaSyCsnD0xt6GCZUiFQPkm1OqsZyaOou3Vv78";
$devices = array('APA91bFxTnr_8rZfMaYIRXTr1mw3L_6rUtJbDUaJvHv9J5jLD8r3SRUedqEOQybRllS6SgzGur0ND9LBSLutDZvXf8H3eziCMD2C4u8frbtQnj1Xp2UgV2Rhp_GR8BZOrDMdel34oEth6leJfE1KnLbsag-Jq2U87P9_88HpfhTXYFQYLfj_gcA');
$message = "Un amigo se encuentra en peligro";

$gcpm = new GCMPushMessage($apiKey);
$gcpm->setDevices($devices);
$response = $gcpm->send($message, array('title' => 'Test title', 'msg'=>'Hola ivan ...'));
echo $response;
?>
