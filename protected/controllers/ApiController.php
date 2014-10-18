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
class ApiController extends Controller
{
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
    public function filters()
    {
            return array();
    }
 
    // Actions
    public function actionRegistroGCM(){
        if(isset($_POST['id_contacto'])){
            $numero_telefono = $_POST['id_contacto'];
            if(isset($_POST['regid'])){
                $regid = $_POST['regid']; 
            }
        }
        
       $usuario = Usuario::model()->findByPk($numero_telefono);
       if($usuario != null){
           $usuario->regid = $regid;
           $usuario->save();
           echo "true";
       }else{
           echo "false";
       }
       
    }
    public function actionRealizaAccion()
    {
        echo "hola";
        echo $_GET['hola'];
        if(isset($_GET['action'])){
            switch($_GET['action']){
                case 'envia_alerta':
                    $model=Usuario::model()->findByPk($_GET['id_usuario']);
                    echo "enviando alerta de :".$model->nombre." para:";
                    $contactos = Contacto::model()->findAll('numero_telefono=:id', array(':id'=>$_GET['id_usuario']));
                    foreach($contactos as $contacto){
                        echo $contacto->nombre;
                    }
                    
                    break;
                case 'guarda_contacto':
                    echo "guardando contacto para: ".$_GET['id_usuario'];
                    break;
            }
        }
    }
    public function actionEnviaAlertas(){
        /*
         * Requiere de la variable id_usuario
         */
        if(isset($_GET['id_usuario'])){
            $id = $_GET['id_usuario']; 
        }
        $usuario = Usuario::model()->findByPk($id);
        if($usuario != null){
            $regids = array();
            $correos = array();
            $contactos = $usuario->contactos;
            /*
             * Verifico si el usuario registra contactos
             */
            if($contactos != null){
                foreach($contactos as $contacto){
                    if($contacto->alerta_gps == 1){
                        $usuario = Usuario::model()->findByPk($contacto->numero);
                        /*
                         * Si el contacto posee una cuenta y se ha registrado con un smartphone
                         * se le podrá enviar una notificacion
                         */
                        if($usuario != null){
                            $regids[] = $usuario->regid;
                        }
                    }
                    if($contacto->alerta_correo == 1){
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
    private function enviarCorreo($correos){
        foreach($correos as $correo){
            echo $correo." ";
        }
    }
    
    private function enviarNotificacion($regids, $usuario){
        Yii::import('application.vendors.*');
        require_once('GCMPushMessage/GCMPushMessage.php');
        if(count($regids) > 0){
            Yii::import('application.vendors.*');
            require_once('GCMPushMessage/GCMPushMessage.php');
            $apiKey = "AIzaSyCsnD0xt6GCZUiFQPkm1OqsZyaOou3Vv78";
//          $devices = array('APA91bFxTnr_8rZfMaYIRXTr1mw3L_6rUtJbDUaJvHv9J5jLD8r3SRUedqEOQybRllS6SgzGur0ND9LBSLutDZvXf8H3eziCMD2C4u8frbtQnj1Xp2UgV2Rhp_GR8BZOrDMdel34oEth6leJfE1KnLbsag-Jq2U87P9_88HpfhTXYFQYLfj_gcA');
            $message = "Un amigo se encuentra en peligro";

            $gcpm = new GCMPushMessage($apiKey);
            $gcpm->setDevices($regids);
            $response = $gcpm->send($message, array('title' => 'Test title', 'msg'=>'Tu amigo '.$usuario->nombre.' se encuentra en peligro'));
            echo $response;
        }
    }


    public function actionUpdate(){
        Yii::import('application.vendors.*');
        require_once('GCMPushMessage/GCMPushMessage.php');
                $apiKey = "AIzaSyCsnD0xt6GCZUiFQPkm1OqsZyaOou3Vv78";
        $devices = array('APA91bFxTnr_8rZfMaYIRXTr1mw3L_6rUtJbDUaJvHv9J5jLD8r3SRUedqEOQybRllS6SgzGur0ND9LBSLutDZvXf8H3eziCMD2C4u8frbtQnj1Xp2UgV2Rhp_GR8BZOrDMdel34oEth6leJfE1KnLbsag-Jq2U87P9_88HpfhTXYFQYLfj_gcA');
        $message = "Un amigo se encuentra en peligro";

        $gcpm = new GCMPushMessage($apiKey);
        $gcpm->setDevices($devices);
        $response = $gcpm->send($message, array('title' => 'Test title', 'msg'=>'Vieja despaila :D'));
        echo $response;
    }
    
    public function actionDelete(){
    }
}

?>
