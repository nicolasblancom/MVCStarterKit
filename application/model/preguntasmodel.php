<?php
class PreguntasModel{

	//Recibo todos las preguntas
	public static function getAll(){
		$conn = Database::getInstance()->getDatabase();
		$ssql = "SELECT * FROM pregunta";
        $query = $conn->prepare($ssql);
        $query->execute();
        return $query->fetchAll();
	}

	//inserto
	public static function insert($datos){
		$conn = Database::getInstance()->getDatabase();

		//validar los datos
		$errores_validacion = false;
        if(empty($datos['asunto'])){
            Session::add('feedback_negative', 'No he recibido el asunto de la pregunta');
            $errores_validacion = true;
            //$errores_validacion[] = "No he recibido el asunto de la pregunta";
        }
        if(empty($datos['cuerpo'])){
            Session::add('feedback_negative', 'No he recibido el cuerpo de la pregunta');
            $errores_validacion = true;
        }
        if($errores_validacion){
            return false;
        }


		$slug = Cadenas::crearSlug($datos['asunto']);

		$params = array(
			':asunto' => $datos['asunto'],
			':cuerpo' => $datos['cuerpo'],
			':slug' => $slug
		);
		$ssql = "INSERT INTO pregunta (asunto, cuerpo, slug) VALUES (:asunto, :cuerpo, :slug)";
		$query = $conn->prepare($ssql);
		$query->execute($params);
 
		$cuenta = $query->rowCount();
		if($cuenta == 1){
			return $conn->lastInsertId();
		}

		return false;
	}

	public static function getId($id)
    {
        $conn = Database::getInstance()->getDatabase();
        $id = (int) $id;
        if ($id==0){
            return false;
        }
        $ssql = "select * from pregunta where id_pregunta=:id";
        $query = $conn->prepare($ssql);
        $query->bindValue(":id", $id, PDO::PARAM_INT);
        $query->execute();
        return $query->fetch();
    }

    public static function getSlug($slug)
    {
        $conn = Database::getInstance()->getDatabase();

        $ssql = "select * from pregunta where slug=:slug";
        $query = $conn->prepare($ssql);
        $query->bindValue(":slug", $slug, PDO::PARAM_STR);
        $query->execute();
        return $query->fetch();
    }

    public static function edit($datos){
        $conn = Database::getInstance()->getDatabase();
        if( empty($datos["asunto"]) || empty($datos["cuerpo"]) || empty($datos["id_pregunta"]) || empty($datos["slug"])){
            //echo "no recibo esos datos (4) necesarios... ";
            return false;
        }else{
            $sql = "UPDATE pregunta SET asunto=:asunto, cuerpo=:cuerpo where id_pregunta=:id and slug=:slug";
            $query = $conn->prepare($sql);
            $parameters = array(
            	':asunto' 	=> $datos["asunto"], 
            	':cuerpo' 	=> $datos["cuerpo"], 
            	':id' 		=> $datos["id_pregunta"],
            	':slug'		=> $datos["slug"]
            );

            // useful for debugging: you can see the SQL behind above construction by using:
            //echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

            $query->execute($parameters);
            $count =  $query->rowCount();
            if ($count == 1) {
                Session::add('feedback_positive', 'Editado con éxito, gracias!!');
                return true;
            }
            //d("Actualizadas 0 casillas");
            Session::add('feedback_positive', 'Actualizadas 0 casillas');
            return true;
        }
    }

    public static function cuantasRespuestas($id){
        $conn = Database::getInstance()->getDatabase();
        $id = (int) $id;
        $sql = "SELECT count(*) as num from respuesta where id_pregunta = :id";
        $query = $conn->prepare($sql);
        $query->bindValue(":id", $id, PDO::PARAM_INT);
        $query->execute();
        $respuestas = $query->fetch();
        return $respuestas->num;
    }

    public static function cuantasRespuestasSlug($slug){
        $conn = Database::getInstance()->getDatabase();
        $datos_preg = self::getSlug($slug);

        $sql = "SELECT count(*) as num from respuesta where id_pregunta = :id";
        $query = $conn->prepare($sql);
        $query->bindValue(":id", $datos_preg->id_pregunta, PDO::PARAM_STR);
        $query->execute();
        $respuestas = $query->fetch();
        return $respuestas->num;
    }

    public static function insertarRespuesta($slug, $respuesta){
        $conn = Database::getInstance()->getDatabase();
        
        //obtengo la pregunta que se desea responder
        $datos_preg = self::getSlug($slug);
        if(!$datos_preg){
            return false;
        }
        
        //valido la respuesta
        if(empty($respuesta["respuesta"])){
            Session::add('feedback_negative', "No he recibido la respuesta");
            return false;
        }
        if(strlen($respuesta["respuesta"]) < 10){
            Session::add('feedback_negative', "La respuesta es demasiado corta");
            Session::add('feedback_negative', "Respuestas válidas a partir de 10 caracteres");
            return false;
        }
        $ssql = "insert into respuesta (respuesta, id_pregunta, id_usuario) values (:res, :idpreg, :usuario)";
        $query = $conn->prepare($ssql);
        $parameters = array(':res' => $respuesta["respuesta"], ':idpreg' => $datos_preg->id_pregunta, ':usuario' => Session::get("user_id"));
        $query->execute($parameters);
        //d($query);
        $count =  $query->rowCount();
        if ($count == 1) {
            //$_SESSION["feedback_positive"][] = "Creado correctamente";
            return $conn->lastInsertId();
        }
        return false;
    }

    public static function cuantasRespuestasIDResp($idRes){
        $conn = Database::getInstance()->getDatabase();
        $idRes = (int) $idRes;
        if ($idRes==0){
            return false;
        }
        $ssql = "select id_pregunta from respuesta where id_respuesta=:id";
        $query = $conn->prepare($ssql);
        $query->bindValue(":id", $idRes, PDO::PARAM_INT);
        $query->execute();
        $preg = $query->fetch();
        //exit($preg->id_pregunta);
        return self::cuantasRespuestas($preg->id_pregunta);
    }

    public static function getRespuestas($id_pregunta){
        $conn = Database::getInstance()->getDatabase();
        $ssql = "SELECT * FROM respuesta WHERE id_pregunta=:id";
        $query = $conn->prepare($ssql);
        $query->execute(array(':id' => $id_pregunta));
        return $query->fetchAll();
    }
}
