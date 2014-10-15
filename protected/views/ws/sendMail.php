<?php
/**
 * EmergenciAPPS@gmail.com
 * emergencia
 */

require 'phpmailer/PHPMailerAutoload.php';


//Recogida de parÃ¡metros


$email=$_POST['correo'];
$mensaje=$_POST['mensaje'];
$lat = $_POST['lat'];
$lng = $_POST['lng'];
$miNombre = $_POST['miNombre'];
$miNumero = $_POST['miNumero'];
$asunto="Ayuda a tu amigo $miNombre";
$link = "http://colvin.chillan.ubiobio.cl:8070/rhormaza/Vista/emergenciaAPPS.php?x=$lat&y=$lng";
$mensaje = "<p>$miNombre dice: \"$mensaje\".</p>";
$mensaje = $mensaje."<p> Puedes llamarlo al siguiente número +569$miNumero,</p><p> o ver dónde se encuentra en el siguiente link:</p> ".$link;
$mensaje = "$mensaje<p>Descarga nuestra aplicación pinchando el icono<a href='#'><img with='64' height='64' src='http://colvin.chillan.ubiobio.cl:8070/rhormaza/Vista/imagen/logo.png'></a></p>";
//Create a new PHPMailer instance
$mail = new PHPMailer();

//Tell PHPMailer to use SMTP
$mail->isSMTP();

//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 0;

//Ask for HTML-friendly debug output
$mail->Debugoutput = "html";

//Set the hostname of the mail server
$mail->Host = 'smtp.gmail.com';

//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 587;

//Set the encryption system to use - ssl (deprecated) or tls
$mail->SMTPSecure = 'tls';

//Whether to use SMTP authentication
$mail->SMTPAuth = true;

//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = "EmergenciAPPS@gmail.com";

//Password to use for SMTP authentication
$mail->Password = "emergencia";

//Set who the message is to be sent from
$mail->setFrom('EmergenciAPPS@gmail.com', 'Alerta EmergenciAPPS');

//Set an alternative reply-to address
$mail->addReplyTo('EmergenciAPPS@gmail.com', 'Alerta EmergenciAPPS');

//Set who the message is to be sent to
$mail->addAddress($email, $email);

//Set the subject line
$mail->Subject = $asunto;

//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
$mail->msgHTML('<p>'.$mensaje.'</p>');

//Replace the plain text body with one created manually
$mail->AltBody = $mensaje;

//Attach an image file
//$mail->addAttachment('images/phpmailer_mini.png');

//send the message, check for errors
if (!$mail->send()) {
    echo "{'respuesta':{'descripcion':'Error: $mail->ErrorInfo'}}" ;
} else {
    echo "{'respuesta':{'descripcion':'Mensaje Enviado Exitosamente'}}";
}
?>
