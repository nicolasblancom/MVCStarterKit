<?php
class Canciones extends Controller{

	public function __construct(){
		parent::__construct();

		//invocar un método que me diga si es un user logueado
		Session::set('origen', '/canciones');
		Auth::checkAutentication();
	}

	public function index(){
		$titulo2 = "Canciones!!!";
		$foo = "lalala";
		require APP . 'view/_templates/header.php';
		//aki está el codigo de la vista, tal cual
        require APP . 'view/canciones/index.php';
        require APP . 'view/_templates/footer.php';
	}

	public function listar(){
		//d($this->model);
		$canciones4 = $this->model->getAllSongs();
		$this->view->render("canciones/listar", array(
			'canciones' => $canciones4,
			'titulo' => 'Listado de canciones'
		));
		//d($canciones);
	}

	public function ver($id = 0){
		$id = (int) $id;
		if($id == 0){
			header("location: /canciones/listar");
		}else{
			$cancion = $this->model->getSong($id);
			$this->view->render('canciones/ver', array(
				'cancion' => $cancion
			));
		}
	}
}