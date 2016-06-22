<?php

class Auth{

	public static function checkAutentication(){
		Session::init();

		if (!Session::userIsLoggedIn()){
			//no está el usuario logueado
			Session::destroy();
			Session::init();
			Session::set('origen', $_SERVER['REQUEST_URI']);
			header ('location: /login');
			exit();
		}

	}
}