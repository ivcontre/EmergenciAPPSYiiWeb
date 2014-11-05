<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */



/**
 * Description of ApiController
 *
 * @author Renato Hormazabal <nato.ehv@gmail.com>
 */
class ApiController extends Controller {

    // Members
    /**
     * Key which has to be in HTTP USERNAME and PASSWORD headers 
     */
    Const APPLICATION_ID = 'ASCCPE';
    
    /**
     * Esta es la key para poder utilizar los servicios de google cloud messagin
     * @var String
     */
    private $API_KEY_GCM = 'AIzaSyCsnD0xt6GCZUiFQPkm1OqsZyaOou3Vv78';

    /*
     * Acciones que se realizarán al momento de enviar un GCM a un dispositivo
     */
    private $NOTIF_CONFIGURACION = 0;
    private $NOTIF_CONTACTOS = 1;
    private $NOTIF_CUENTA = 2;
    private $NOTIF_ALERTA = 3;
    /**
     * Default response format
     * either 'json' or 'xml'
     */
    private $format = 'json';

    /**
     * @return array action filters
     */
    public function filters() {
        return array();
    }

    // Actions
    public function actionRegistroGCM() {
        if (isset($_POST['id_contacto'])) {
            $numero_telefono = $_POST['id_contacto'];
            if (isset($_POST['regid'])) {
                $regid = $_POST['regid'];
            }
        }

        $usuario = Usuario::model()->findByPk($numero_telefono);
        if ($usuario != null) {
            $usuario->regid = $regid;
            $usuario->save();
            echo "true";
        } else {
            echo "false";
        }
    }

    public function actionActualizaPosicion() {
       if(isset($_REQUEST['lat']) && isset($_REQUEST['lng']) && isset($_REQUEST['id_usuario'])){       
           $lat = $_REQUEST['lat'];
           $lng = $_REQUEST['lng'];
           
           $numero_telefono = $_REQUEST['id_usuario'];
           $usuario = Usuario::model()->findByPk($numero_telefono);
           if($usuario != null){
               if($lat != 0 && $lng != 0){
                    $usuario->latitud = $lat;
                    $usuario->longitud = $lng;
                    if($usuario->save()){
                        echo "ubicacion actualizada correctamente";
                    }else{
                        echo "ubicacion no pudo ser actualizada";
                    }
               }else{
                   $usuario->latitud = $lat;
                   $usuario->longitud = $lng;
                   $usuario->estado_alerta = 0;                  
                    if($usuario->save()){
                        echo "true";
                    }else{
                        echo "false";
                    }
                    $notificaciones = Notificacion::model()->findAllByAttributes(array('numero_telefono'=>$usuario->numero_telefono,'estado'=>1));
                    if($notificaciones != null){
                        foreach($notificaciones as $notificacion){
                            
                            $notificacion->estado = 0;
  
                            $notificacion->save();
                        }   
                    }
                    
               }
           }
       }
    }

    public function actionEnviaAlerta() {
        /*
         * Requiere de la variable id_usuario
         */
        if (isset($_REQUEST['id_usuario'])) {
            $id = $_REQUEST['id_usuario'];
        }
        $lat = $_REQUEST['lat'];
        $lng = $_REQUEST['lng'];
        $usuario = Usuario::model()->findByPk($id);
        if ($usuario != null) {
            $usuario->estado_alerta = 1;
            $usuario->latitud = $lat;
            $usuario->longitud = $lng;
            if($usuario->save()){
                echo 'true';
            }
            
            $regids = array();
            $correos = array();
            $contactos = $usuario->contactos;
            /*
             * Verifico si el usuario registra contactos
             */
            $notifiContactos = array();
            if ($contactos != null) {
                foreach ($contactos as $contacto) {
                    if ($contacto->alerta_gps == 1) {
                        //TODO crear tabla notificación 
                        $usu = Usuario::model()->findByPk($contacto->numero);
                        $notifiContactos[] = $contacto->numero; 
                        /*
                         * Si el contacto posee una cuenta y se ha registrado con un smartphone
                         * se le podrá enviar una notificacion
                         */
                        if ($usu != null) {
                            $regids[] = $usu->regid;
                        }
                    }
                    if ($contacto->alerta_correo == 1) {
                        $correos[] = $contacto->correo;
                    }
                }
                foreach($notifiContactos as $numero_contacto){
                    $notificacion = new Notificacion();
                    $notificacion->numero_contacto = $numero_contacto;
                    $notificacion->numero_telefono = $id;
                    $notificacion->estado = 1;
                    if(!$notificacion->save())
                        echo var_dump($notificacion->getErrors());
                }
                $this->enviarCorreos($correos, $usuario);
                $this->enviarNotificacion($regids, $usuario);
            }
        }
    }

    /**
     * Funcion encargada de enviar correos a una lista de contactos
     * 
     * @param type $correos
     */
    public function enviarCorreos($correos, $usuario) {
        Yii::import('application.vendors.*');
        require_once('PHPMailer/PHPMailerAutoload.php');
        
        $configuracion = $usuario->configuracion;
        
        $mensaje_alerta = $configuracion->mensaje_alerta;

        $miNombre = $usuario->nombre;
        $miApellido = $usuario->apellido;
        $miCorreo = $usuario->correo;
        $lat = $usuario->latitud;
        $lng = $usuario->longitud;
        
        $mail = new PHPMailer();
        $mail->isSMTP();
        
        $mail->SMTPDebug = 0;

        $mail->Debugoutput = "html";

        $mail->Host = 'smtp.gmail.com';

        $mail->Port = 587;

        $mail->SMTPSecure = 'tls';

        $mail->SMTPAuth = true;

        $mail->Username = "EmergenciAPPS@gmail.com";

        $mail->Password = "emergencia";

        $mail->setFrom('EmergenciAPPS@gmail.com', 'Alerta EmergenciAPPS');
        
        $asunto="Ayuda a tu amigo $miNombre ".$miApellido;
        $mail->Subject = $asunto;
        
        $link = "http://colvin.chillan.ubiobio.cl:8070/rhormaza/Vista/emergenciaAPPS.php?x=$lat&y=$lng";
        $mensaje = "<p>$miNombre ".$miApellido." dice: \"$mensaje_alerta\".</p>";
        $mensaje = $mensaje."<p> Puedes llamarlo al siguiente número +569$usuario->numero_telefono,</p><p> o ver dónde se encuentra en el siguiente link:</p> ".$link;

        $mail->msgHTML('<p>'.$mensaje.'</p>');
        $mail->AltBody = $mensaje;
        foreach ($correos as $correo){
            
            $mail->addAddress($correo, $correo);
            $mail->send();
        }
        
        
        
        
    }
    /**
     * Funcion encargada de enviar notificacion a usuarios registrados con un dispositivo
     * movil
     */
    private function enviarNotificacion($regids, $usuario) {
        Yii::import('application.vendors.*');
        require_once('GCMPushMessage/GCMPushMessage.php');
        if (count($regids) > 0) {
            Yii::import('application.vendors.*');
            require_once('GCMPushMessage/GCMPushMessage.php');
            //$apiKey = "AIzaSyCsnD0xt6GCZUiFQPkm1OqsZyaOou3Vv78";
//          $devices = array('APA91bFxTnr_8rZfMaYIRXTr1mw3L_6rUtJbDUaJvHv9J5jLD8r3SRUedqEOQybRllS6SgzGur0ND9LBSLutDZvXf8H3eziCMD2C4u8frbtQnj1Xp2UgV2Rhp_GR8BZOrDMdel34oEth6leJfE1KnLbsag-Jq2U87P9_88HpfhTXYFQYLfj_gcA');
            $message = $usuario->configuracion->mensaje_alerta;
            
            $gcpm = new GCMPushMessage($this->API_KEY_GCM);
            $gcpm->setDevices($regids);
            $response = $gcpm->send($message, array('opcion' => 3, 'nombre' => $usuario->nombre,'msg'=>$message));
            
        }
    }
    /**
     * Metodo encargado de obtener a todos los usuarios que requieren de mi ayuda
     * 
     */
    public function actionAlertas(){
        if(isset($_REQUEST['id_usuario'])){
            $id = $_REQUEST['id_usuario'];
            $usuario = Usuario::model()->findByPk($id);
            if($usuario != null){
                $response = array();
                $notificaciones = Notificacion::model()->findAllByAttributes(array('numero_contacto'=>$id, 'estado'=>'1'));
                if($notificaciones != null){
                    foreach($notificaciones as $notificacion){
                        $user = $notificacion->usuario;
                        $response[] = array('nombre'=>$user->nombre, 'lat'=>$user->latitud, 'lng'=>$user->longitud, 'numero_telefono'=> $user->numero_telefono);
                    }
                    echo json_encode($response);
                }
            }
            
        }
        echo "false";
    }

    public function actionCercanos() {
        $tabla = $_GET['tabla'];
        $lat = (float) $_GET['lat'];
        $lng = (float) $_GET['lng'];
        
        $usuario = Usuario::model()->findByPk(Yii::app()->user->id);
        $conf = $usuario->configuracion;
        $distance = $conf->radio_busqueda;
        $id_configuracion = $conf->id_configuracion;
        if($distance == null)
            $distance = 5;
       
        $box = $this->get_boundaries($lat, $lng, $distance);

       
        
        $laConsulta = 'SELECT ' . $tabla . '.id AS id, ' . $tabla . '.nombre AS nombre, ' . $tabla . '.x AS x, ' . $tabla . '.y AS y, ' . $tabla . '.direccion AS direccion,' . $tabla . '.telefono AS telefono ,comuna.nombre AS nombre

                                            , ( 6371 * ACOS( 
                                                 COS( RADIANS(' . $lat . ') ) 
                                                 * COS(RADIANS( x ) ) 
                                                 * COS(RADIANS( y ) 
                                                 - RADIANS(' . $lng . ') ) 
                                                 + SIN( RADIANS(' . $lat . ') ) 
                                                 * SIN(RADIANS( x ) ) 
                                                )
                                   ) AS distance 
                         FROM ' . $tabla . ', comuna 
                         WHERE (x BETWEEN ' . $box['min_lat'] . ' AND ' . $box['max_lat'] . ')
                         AND (y BETWEEN ' . $box['min_lng'] . ' AND ' . $box['max_lng'] . ')
                             AND comuna.id_comuna = ' . $tabla . '.id_comuna
                         HAVING distance < ' . $distance . ' 
                         ORDER BY distance ASC';
        
        
        $command = Yii::app()->db->createCommand($laConsulta);
        $rows = $command->queryAll();
        $count = $command->queryScalar();
        
        $total = array();
        $filas = array();
        if($count > 0){
           foreach($rows as $row){
                $columna = array();
                $columna['id'] = $row['id'];
                $columna['nombre'] = utf8_encode($row['nombre']);
                $columna['lat'] = $row['x'];
                $columna['lng'] = $row['y'];
                $columna['direccion'] = utf8_encode($row['direccion']);
                $columna['telefono'] = $row['telefono'];
                $columna['distancia'] = $row['distance'];
                $columna['comuna'] = utf8_encode($row['nombre']);
                $filas[] = $columna;
            }

            
            $total[$tabla] = $filas;
            $total['comuna'] = $filas[0]['comuna'];

            echo json_encode($total); 
        }else{
            $total[$tabla] = 0;
            $total['radio'] = $distance;
            $total['id_config'] = $id_configuracion;

            echo json_encode($total); 
        }
        
       
        
        
    }

    public function get_boundaries($lat, $lng, $distance = 1, $earthRadius = 6371) {
        $return = array();

        // Los angulos para cada dirección
        $cardinalCoords = array('north' => '0',
            'south' => '180',
            'east' => '90',
            'west' => '270');

        $rLat = deg2rad($lat);
        $rLng = deg2rad($lng);
        $rAngDist = $distance / $earthRadius;

        foreach ($cardinalCoords as $name => $angle) {
            $rAngle = deg2rad($angle);
            $rLatB = asin(sin($rLat) * cos($rAngDist) + cos($rLat) * sin($rAngDist) * cos($rAngle));
            $rLonB = $rLng + atan2(sin($rAngle) * sin($rAngDist) * cos($rLat), cos($rAngDist) - sin($rLat) * sin($rLatB));

            $return[$name] = array('lat' => (float) rad2deg($rLatB),
                'lng' => (float) rad2deg($rLonB));
        }

        return array('min_lat' => $return['south']['lat'],
            'max_lat' => $return['north']['lat'],
            'min_lng' => $return['west']['lng'],
            'max_lng' => $return['east']['lng']);
    }
    
    public function actionPorComuna() {
        $tabla = $_GET['tabla'];
        $id_comuna = $_GET['id_comuna'];
        
        $laConsulta = 'SELECT ' . $tabla . '.id AS id, ' . $tabla . '.nombre AS nombre, ' . $tabla . '.x AS x, ' . $tabla . '.y AS y, ' . $tabla . '.direccion AS direccion,' . $tabla . '.telefono AS telefono ,comuna.nombre AS nombre
                         FROM ' . $tabla . ', comuna
                         WHERE ' . $tabla . '.id_comuna = ' . $id_comuna . ' '
                . '      AND ' . $tabla . '.id_comuna = comuna.id_comuna';
        
        
        $command = Yii::app()->db->createCommand($laConsulta);
        $rows = $command->queryAll();
        $count = $command->queryScalar();
        $filas = array();
        $total = array();
        if($count > 0){
            foreach($rows as $row){
                $columna = array();
                $columna['id'] = $row['id'];
                $columna['nombre'] = utf8_encode($row['nombre']);
                $columna['lat'] = $row['x'];
                $columna['lng'] = $row['y'];
                $columna['direccion'] = utf8_encode($row['direccion']);
                $columna['telefono'] = $row['telefono'];

                $columna['comuna'] = $row['nombre'];
                $filas[] = $columna;
            }

            
            $total[$tabla] = $filas;
            $total['comuna'] = $filas[0]['comuna']; 
            echo json_encode($total);
        }else{
            $laConsulta = 'SELECT * FROM comuna WHERE id_comuna = '.$id_comuna.'';
            
            $command = Yii::app()->db->createCommand($laConsulta);
            $rows = $command->queryAll();
            $filas = 0;
            $total[$tabla] = $filas;
            
            foreach($rows as $row){
                $total['comuna'] = utf8_encode($row['nombre']);
            }
                    
            
            
            echo json_encode($total);
        }
        
        

       
        
    }
    
    public function actionEliminarRegId(){
        if (isset($_REQUEST['id_usuario'])) {
            $id = $_REQUEST['id_usuario'];
        }
        $usuario = Usuario::model()->findByPk($id);
        if($usuario != null){
            $usuario->regid = " ";
            
        }
        if($usuario->save()){
            echo "true";
        }else{
            echo "false";
        }
        
        
    }
    
    public function actionGetContactos(){
        if (isset($_REQUEST['id_usuario'])) {
            $id = $_REQUEST['id_usuario'];
        }
        
        $contactos = Contacto::model()->findAllByAttributes(array('numero_telefono'=>$id));
        $arrayContactos = Array();
        
        foreach($contactos as $con){
           $contacto['id_contacto'] = $con['id_contacto'];
           $contacto['nombre'] = utf8_encode($con['nombre']);
           $contacto['numero_telefono'] = $con['numero_telefono'];
           $contacto['numero'] = $con['numero'];
           $contacto['correo'] = $con['correo'];
           $contacto['alerta_sms'] = $con['alerta_sms'];
           $contacto['alerta_gps'] = $con['alerta_gps'];
           $contacto['alerta_correo'] = $con['alerta_correo'];
           $contacto['estado'] = $con['estado'];
           $arrayContactos[] = $contacto;
        }
         
         echo json_encode($arrayContactos);
        
        
        
    }

}

?>
