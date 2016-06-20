<?php
class Miguel extends Controller{

	public function index(){
		echo "Estoy en index del controlador Miguel";
	}

	public function acercade(){
		echo "Miguel es un desarrollador nacido en Madrid.";
		foo();
	}

	public function comer($comida, $donde){
		if(!$_POST){
			?>
			<form action="<?=$_SERVER["REQUEST_URI"]?>" method="post">
			<input type="text" name="kk">
			<input type="submit">
			</form>
			<?php
		}else{
			foo();
		}
	}

	private function foo(){
		echo "miguel es....<br>";
		echo $_POST["kk"];
		echo "Miguel come $comida en $donde";
	}
}
