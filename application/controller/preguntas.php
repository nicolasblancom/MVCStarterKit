<?php

class Preguntas extends Controller{

	public function todas(){
		//mostrar todas las preguntas
		$preguntas = PreguntasModel::getAll();
		echo $this->view->render('preguntas/todas', array(
			'preguntas' => $preguntas
		));
		//d($preguntas);
	}

	public function crear(){
		Auth::checkAutentication();
		if(!$_POST){
			//es que no recibo datos de formulario
			echo $this->view->render('preguntas/formulariopregunta');
		}else{
			//recibo datos, los inserto
			//pequeña comprobación de $_POST
			if(!isset($_POST["asunto"]))
				$_POST["asunto"] = "";
			if(!isset($_POST["cuerpo"]))
				$_POST["cuerpo"] = "";

			$datos = array(
				'asunto' => $_POST["asunto"],
				'cuerpo' => $_POST["cuerpo"]
			);

			if(PreguntasModel::insert($datos)){
				echo $this->view->render('preguntas/preguntainsertada');
			}else{
				echo $this->view->render('preguntas/formulariopregunta', array(
					'errores' => array('Error al insertar'),
					'datos' => $_POST
				));
			}
		}
	}

	public function editar($slug = ""){
		if(!$_POST){
			//no recibo datos de formulario,
			//muestro el formulario con los datos del elemento que se pretende editar
			$pregunta = PreguntasModel::getSlug($slug);
			if($pregunta){
				//encontré una pregunta con ese slug
				echo $this->view->render('preguntas/formulariopregunta', array(
					'datos' => get_object_vars($pregunta),
					'accion' => 'editar'
				));
			}else{
				//no obtuve una pregunta con ese slug
				header("location: /preguntas/todas");
			}
		}else{
			//recibo datos de formulario
			$datos = array(
				'asunto' 		=> (isset($_POST["asunto"])) ? $_POST["asunto"] : "",
				'cuerpo' 		=> (isset($_POST["cuerpo"])) ? $_POST["cuerpo"] : "",
				'id_pregunta' 	=> (isset($_POST["id_pregunta"])) ? $_POST["id_pregunta"] : "",
				'slug'			=> $slug
			);
			//Los mando al modelo para actualiza
			if(PreguntasModel::edit($datos)){
				//lleva a la página del listado de preguntas donde se mostrarán los mensajes de feedback positive
				header('location: /preguntas/todas');
				// como alternativa puedes mostrar los mensajes y el propio form de edición
				/*
				$this->view->render('preguntas/formulariopregunta', array(
					'datos' => $_POST,
					'accion' => 'editar'
				));
				*/
			}else{
				echo $this->view->render('preguntas/formulariopregunta', array(
					'errores' => array('Error al editar'),
					'datos' => $_POST,
					'accion' => 'editar'
				));
			}
		}
	}

	public function cuantasRespuestas($id = 0){
		$cuantas = PreguntasModel::cuantasRespuestas($id);
		echo $this->view->render('preguntas/cuantasRespuestas', array('cuantas' => $cuantas));
	}

	public function enviarRespuesta($slug = ""){
		Auth::checkAutentication();
		if(!$_POST){
			$pregunta = PreguntasModel::getSlug($slug);
			echo $this->view->render('preguntas/formulariorespuesta', array('pregunta' => $pregunta));
		}else{
			$res = PreguntasModel::insertarRespuesta($slug, $_POST);
			echo $this->view->render("preguntas/respuestaInsertada", array('respuesta' => $res));
		}

	}

	public function enviarRespuestaJSON($slug = ""){
		Auth::checkAutentication();
		if(!$_POST){
			$pregunta = PreguntasModel::getSlug($slug);
			$cuantas = PreguntasModel::cuantasRespuestasSlug($slug);
			echo $this->view->render('preguntas/formulariorespuestaJSON', 
				array(
					'pregunta' => $pregunta,
					'cuantas' => $cuantas
				));
		}else{
			$res = PreguntasModel::insertarRespuesta($slug, $_POST);
			$cuantas = PreguntasModel::cuantasRespuestasSlug($slug);
			echo $this->view->render("preguntas/respuestaInsertadaJSON", 
				array(
					'respuesta' => $res,
					'cuantas' => $cuantas
					));
		}

	}

	public function getJSONrespuestas($idPreg = 0){
        $respuestas = PreguntasModel::getRespuestas($idPreg);
        echo $this->view->render('preguntas/jsonrespuestas', array('respuestas' => $respuestas));
        
    }

}