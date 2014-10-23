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

    public function actionRealizaAccion() {
        echo "hola";
        echo $_GET['hola'];
        if (isset($_GET['action'])) {
            switch ($_GET['action']) {
                case 'envia_alerta':
                    $model = Usuario::model()->findByPk($_GET['id_usuario']);
                    echo "enviando alerta de :" . $model->nombre . " para:";
                    $contactos = Contacto::model()->findAll('numero_telefono=:id', array(':id' => $_GET['id_usuario']));
                    foreach ($contactos as $contacto) {
                        echo $contacto->nombre;
                    }

                    break;
                case 'guarda_contacto':
                    echo "guardando contacto para: " . $_GET['id_usuario'];
                    break;
            }
        }
    }

    public function actionEnviaAlertas() {
        /*
         * Requiere de la variable id_usuario
         */
        if (isset($_GET['id_usuario'])) {
            $id = $_GET['id_usuario'];
        }
        $usuario = Usuario::model()->findByPk($id);
        if ($usuario != null) {
            $regids = array();
            $correos = array();
            $contactos = $usuario->contactos;
            /*
             * Verifico si el usuario registra contactos
             */
            if ($contactos != null) {
                foreach ($contactos as $contacto) {
                    if ($contacto->alerta_gps == 1) {
                        $usuario = Usuario::model()->findByPk($contacto->numero);
                        /*
                         * Si el contacto posee una cuenta y se ha registrado con un smartphone
                         * se le podrá enviar una notificacion
                         */
                        if ($usuario != null) {
                            $regids[] = $usuario->regid;
                        }
                    }
                    if ($contacto->alerta_correo == 1) {
                        $correos[] = $contacto->correo;
                    }
                }

                $this->enviarCorreo($correos);
                $this->enviarNotificacion($regids, $usuario);
            }
        }
    }

    /**
     * Funcion encargada de enviar correos a una lista de contactos
     * 
     * @param type $correos
     */
    private function enviarCorreo($correos) {
        foreach ($correos as $correo) {
            echo $correo . " ";
        }
    }

    private function enviarNotificacion($regids, $usuario) {
        Yii::import('application.vendors.*');
        require_once('GCMPushMessage/GCMPushMessage.php');
        if (count($regids) > 0) {
            Yii::import('application.vendors.*');
            require_once('GCMPushMessage/GCMPushMessage.php');
            $apiKey = "AIzaSyCsnD0xt6GCZUiFQPkm1OqsZyaOou3Vv78";
//          $devices = array('APA91bFxTnr_8rZfMaYIRXTr1mw3L_6rUtJbDUaJvHv9J5jLD8r3SRUedqEOQybRllS6SgzGur0ND9LBSLutDZvXf8H3eziCMD2C4u8frbtQnj1Xp2UgV2Rhp_GR8BZOrDMdel34oEth6leJfE1KnLbsag-Jq2U87P9_88HpfhTXYFQYLfj_gcA');
            $message = "Un amigo se encuentra en peligro";

            $gcpm = new GCMPushMessage($apiKey);
            $gcpm->setDevices($regids);
            $response = $gcpm->send($message, array('title' => 'Test title', 'msg' => 'Tu amigo ' . $usuario->nombre . ' se encuentra en peligro'));
            echo $response;
        }
    }

    public function actionUpdate() {
        Yii::import('application.vendors.*');
        require_once('GCMPushMessage/GCMPushMessage.php');
        $apiKey = "AIzaSyCsnD0xt6GCZUiFQPkm1OqsZyaOou3Vv78";
        $devices = array('APA91bFxTnr_8rZfMaYIRXTr1mw3L_6rUtJbDUaJvHv9J5jLD8r3SRUedqEOQybRllS6SgzGur0ND9LBSLutDZvXf8H3eziCMD2C4u8frbtQnj1Xp2UgV2Rhp_GR8BZOrDMdel34oEth6leJfE1KnLbsag-Jq2U87P9_88HpfhTXYFQYLfj_gcA');
        $message = "Un amigo se encuentra en peligro";

        $gcpm = new GCMPushMessage($apiKey);
        $gcpm->setDevices($devices);
        $response = $gcpm->send($message, array('title' => 'Test title', 'msg' => 'Vieja despaila :D'));
        echo $response;
    }

    public function actionCercanos() {
        $tabla = $_GET['tabla'];
        $lat = (float) $_GET['lat'];
        $lng = (float) $_GET['lng'];
        
        $usuario = Usuario::model()->findByPk(Yii::app()->user->id);
        foreach ($usuario->configuracion as $conf) {
            $distance = $conf->radio_busqueda;
        }
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
        
        
        $rows = Yii::app()->db->createCommand($laConsulta)->queryAll();
        
        $filas = array();
        
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

        $total = array();
        $total[$tabla] = $filas;
        $total['comuna'] = $filas[0]['comuna'];
        
        echo json_encode($total);
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
            
            $filas = null;
            $total[$tabla] = $filas;
            $total['comuna'] = $filas[0]['comuna']; 
            echo json_encode($total);
        }
        
        

       
        
    }

}

?>
