<?php

class Login extends Controller{

	public function index(){
		echo $this->view->render('login/index');
	}

	public function dologin(){
		if(LoginModel::dologin($_POST)){
			if($origen = Session::get('origen')){
				Session::set('origen', null);
				header ('location:' . $origen);
				exit();
			}else{
				echo $this->view->render('login/usuariologueado');
			}
		}else{
			header('location: /login');
			exit(); //recomendable
		}
	}

	public function salir(){
		LoginModel::salir();
	}
}