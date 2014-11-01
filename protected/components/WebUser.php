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
                if($conf->numero_pdi == null){
                    $msg = $msg."<li>Agrega un número favorito de un departamento de Policia de Investigaciones</li>";
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
    
}
?>
