<?php

class Privado extends Controller{

	public function __construct(){
		parent::__construct();

		//invocar un método que me diga si es un user logueado
		Session::set('origen', '/privado');
		Auth::checkAutentication();
	}

	public function index(){
		echo $this->view->render("privado/index");
	}

}

