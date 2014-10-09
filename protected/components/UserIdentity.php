<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
                $user = Usuario::model()->findByAttributes(array('numero_telefono' => $this->username));
                
                if($user === null){
                    $this->errorCode=self::ERROR_USERNAME_INVALID;
                }else{
                    if($user->password != $this->password){
                        $this->errorCode=self::ERROR_PASSWORD_INVALID;
                    }else{
                        if($user->idTipoUsuario->nombre === "Usuario"){
                            $this->username = "user";
                            $this->errorCode = self::ERROR_NONE;
                            $this->setState('numero_telefono', $user->numero_telefono);
                        }else{
                            $this->username = "admin";
                            $this->errorCode = self::ERROR_NONE;
                            $this->setState('numero_telefono', $user->numero_telefono);
                        }
                    }
                }
               
		return !$this->errorCode;
	}
}