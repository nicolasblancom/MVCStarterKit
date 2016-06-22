<?php
class LoginModel {

	public static function dologin($datos){
		//validaciones de los datos
		//d($datos);
		if(!$datos){
			Session::add("feedback_negative", 'No tengo datos de login');
			return false;
		}
		if(empty($datos['email'])){
			Session::add("feedback_negative", 'No se ha indicado el email');
		}
		if(empty($datos['clave'])){
			Session::add("feedback_negative", 'No se ha indicado la clave');
		}
		if(Session::get("feedback_negative")){
			return false;
		}
		$datos['email'] = trim($datos['email']);
		if(!filter_var($datos['email'], FILTER_VALIDATE_EMAIL)){
			Session::add("feedback_negative", 'El login debe de ser un email válido');
		}
		if(strlen($datos['clave']) < 4){
			Session::add("feedback_negative", 'La clave debe tener 4 o más caracteres');
		}
		if(Session::get("feedback_negative")){
			return false;
		}
		//si estoy aquí es que los datos están validados

		//conecto la base de datos
        $conn = Database::getInstance()->getDatabase();

    	//construyo la sentencia para buscar ese usuario
        $sql = "SELECT nombre, id_usuario, id_perfil, pass FROM usuario WHERE login=:email";
        $query = $conn->prepare($sql);
        $query->bindValue(':email', $datos['email'], PDO::PARAM_STR);
        $query->execute();

        $cuantos = $query->rowCount();
        if($cuantos != 1){
        	Session::add("feedback_negative", 'No se encuentra un usuario (login)');
        	return false;
        }

        //es que encontre un user, verificar clave
        $usuario = $query->fetch();
        if($usuario->pass != sha1($datos['clave'])){
        	Session::add("feedback_negative", 'No se encuentra un usuario (password)');
        	return false;
        }

        //d($usuario);
        //si estoy aqui es que el usuario y clave son validos
        //iniciar la sesión
        Session::set('user_id', $usuario->id_usuario);
        Session::set('user_name', $usuario->nombre);
        Session::set('user_email', $datos["email"]);
        Session::set('user_logged_in', true);


        //como alternativa podríamos guardar todos los datos del usurio en un array o bien usar un objeto usuario
        //$user = new User($usuari->nombre, ...);
        //Session::set('objuser', $user);

        //usuario validado y sesión iniciada!!!!!
		return true;
	}

	public static function salir(){
		Session::destroy();
		header('location: /');
		exit();
	}
}