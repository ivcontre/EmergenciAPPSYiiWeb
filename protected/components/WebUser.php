<?php
 
// this file must be stored in:
// protected/components/WebUser.php
 
class WebUser extends CWebUser {
 
  // Store model to not repeat query.
  private $_model;
 
  // Return first name.
  // access it by Yii::app()->user->nombre
  function getNombre(){
    $user = $this->loadUser(Yii::app()->user->id);
    if($user!= null)
        return $user->nombre;
    return 'null';
  }
 
  // This is a function that checks the field 'role'
  // in the User model to be equal to 1, that means it's admin
  // access it by Yii::app()->user->isAdmin()
  function isAdmin(){
    $user = $this->loadUser(Yii::app()->user->id);
    if($user != null)
        return intval($user->id_tipo_usuario) == 2;
    return false;
  }
 
  function isUser(){
    $user = $this->loadUser(Yii::app()->user->id);
    if($user != null)
        return intval($user->id_tipo_usuario) == 1;
    return false;
  }
  // Load user model.
  protected function loadUser($id=null)
    {
        if($this->_model===null)
        {
            if($id!==null)
                $this->_model=Usuario::model()->findByPk($id);
        }
        return $this->_model;
    }
    
    function getIdConfiguracion(){
        $user = $this->loadUser(Yii::app()->user->id);
        if($user != null){
            $conf = $user->configuracion;
            if(isset($conf))
                return $conf->id_configuracion;
            return -1;
        }
    }
    
    function obtenerNotificacionesGrafico(){
        $notificaciones = Yii::app()->db->createCommand()
            ->select('COUNT(*) as cantidad, DATE(fecha) as fecha')
            ->from('Notificacion')  //Your Table name
            ->group('DATE(fecha)') 
            ->where('fecha BETWEEN date_sub(NOW(), INTERVAL 7 DAY)  AND sysdate()') // Write your where condition here
            ->queryAll(); 
        //obtener registrados en los ultimos 7 dias
        $registrados = Yii::app()->db->createCommand()
            ->select('COUNT(*) as cantidad, DATE(fecha_ingreso) as fecha')
            ->from('usuario')  //Your Table name
            ->group('DATE(fecha_ingreso)') 
            ->where('fecha_ingreso BETWEEN date_sub(NOW(), INTERVAL 7 DAY)  AND sysdate()') // Write your where condition here
            ->queryAll();
        date_default_timezone_set("America/Santiago");
        $fechaActual = date("Y-m-d");
        $categories = array(
            date("Y-m-d",strtotime('-6 day',strtotime($fechaActual))),
            date("Y-m-d",strtotime('-5 day',strtotime($fechaActual))),
            date("Y-m-d",strtotime('-4 day',strtotime($fechaActual))),
            date("Y-m-d",strtotime('-3 day',strtotime($fechaActual))),
            date("Y-m-d",strtotime('-2 day',strtotime($fechaActual))),
            date("Y-m-d",strtotime('-1 day',strtotime($fechaActual))),
            $fechaActual);
        $dataNotificacion = array(0,0,0,0,0,0,0);
        $dataRegistrados = array(0,0,0,0,0,0,0);
        
        for($i=0; $i<count($notificaciones); $i++){
            for($j=0; $j<count($categories); $j++){
                if($notificaciones[$i]['fecha'] == $categories[$j])
                    $dataNotificacion[$j] = intval($notificaciones[$i]['cantidad']);
            }
        }
        
        for($i=0; $i<count($registrados); $i++){
            for($j=0; $j<count($categories); $j++){
                if($registrados[$i]['fecha'] == $categories[$j])
                    $dataRegistrados[$j] = intval($registrados[$i]['cantidad']);
            }
        }
        $response['categories'] = $categories;
        $response['dataNotificaciones'] = $dataNotificacion;
        $response['dataRegistrados'] = $dataRegistrados;
        return $response;
    }
    
    function obtenerNotificacionesGraficoUsuario(){
        $notificaciones = Yii::app()->db->createCommand()
            ->select('COUNT(*) as cantidad, DATE(fecha) as fecha')
            ->from('Notificacion')  //Your Table name
            ->group('DATE(fecha)') 
            ->where('numero_telefono = "'.Yii::app()->user->id.'" and fecha BETWEEN date_sub(NOW(), INTERVAL 7 DAY)  AND sysdate()') // Write your where condition here
            ->queryAll(); 

        date_default_timezone_set("America/Santiago");
        $fechaActual = date("Y-m-d");
        $categories = array(
            date("Y-m-d",strtotime('-6 day',strtotime($fechaActual))),
            date("Y-m-d",strtotime('-5 day',strtotime($fechaActual))),
            date("Y-m-d",strtotime('-4 day',strtotime($fechaActual))),
            date("Y-m-d",strtotime('-3 day',strtotime($fechaActual))),
            date("Y-m-d",strtotime('-2 day',strtotime($fechaActual))),
            date("Y-m-d",strtotime('-1 day',strtotime($fechaActual))),
            $fechaActual);
        $dataNotificacion = array(0,0,0,0,0,0,0);

        
        for($i=0; $i<count($notificaciones); $i++){
            for($j=0; $j<count($categories); $j++){
                if($notificaciones[$i]['fecha'] == $categories[$j])
                    $dataNotificacion[$j] = intval($notificaciones[$i]['cantidad']);
            }
        }

        $response['categories'] = $categories;
        $response['dataNotificaciones'] = $dataNotificacion;

        return $response;
    }
    /**
     * Metodo encargado de verificar avisos para usuario
     * @return Array
     */
    function verificaAvisos(){
        $mensajes = array();
        $user = $this->loadUser(Yii::app()->user->id);
        if($user != null){
            $conf = $user->configuracion;
            $msg = "<ul>";
            
            if($conf != null){
                if($conf->mensaje_alerta == null){
                    $msg = $msg."<li>Agrega un mensaje de alerta</li>";
                }
                if($conf->radio_busqueda == null){
                    $msg = $msg."<li>Agrega un radio de búsqueda</li>";
                }
                if($conf->numero_centro_medico == null){
                    $msg = $msg."<li>Agrega un número favorito de un centro médico</li>";
                }
                if($conf->numero_bombero == null){
                    $msg = $msg."<li>Agrega un número favorito de un cuerpo de bomberos</li>";
                }
                if($conf->numero_carabinero == null){
                    $msg = $msg."<li>Agrega un número favorito de una comisaría</li>";
                }
               

            }
            if($user->regid == null){
                $msg2 = "Tu cuenta no está aún vinculada a un dispositivo móvil, ¡Que esperas para hacerlo!";
            }
            if($msg != "<ul>")
                $mensajes[] = array("msg"=>"Todavía no has terminado de configurar tu cuenta: \n".$msg."</ul>", "color"=>TbHtml::ALERT_COLOR_WARNING);
            if(isset($msg2))
                $mensajes[] = array("msg"=>$msg2,"color"=>TbHtml::ALERT_COLOR_INFO);
            return $mensajes;
        }
    }
    
    public function countAlertas(){
        if(!Yii::app()->user->isGuest){
            $alertas = Yii::app()->db->createCommand()
                ->select('COUNT(*) as cantidad')
                ->from('Notificacion')  //Your Table name
                ->where('numero_contacto='.Yii::app()->user->id.' and estado=1') // Write your where condition here
                ->queryAll(); 
            if($alertas[0]['cantidad'] > 0){
                return TbHtml::badge($alertas[0]['cantidad'], array('color' => TbHtml::BADGE_COLOR_IMPORTANT));
            }else{
                return TbHtml::badge('0', array('color' => TbHtml::BADGE_COLOR_INFO));
            }
        }
    }
    
    public function getUsuario(){
       return $this->loadUser(Yii::app()->user->id);
    }
    
    
}
?>
