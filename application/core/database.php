<?php
class Database{
	private static $instancia = null;
	private $db = null;

	private function __construct(){
		//Tareas de inicialización
		// set the (optional) options of the PDO connection. in this case, we set the fetch mode to
        // "objects", which means all results will be objects, like this: $result->user_name !
        // For example, fetch mode FETCH_ASSOC would return results like this: $result["user_name] !
        // @see http://www.php.net/manual/en/pdostatement.fetch.php
        $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING);

        // generate a database connection, using the PDO connector
        // @see http://net.tutsplus.com/tutorials/php/why-you-should-be-using-phps-pdo-for-database-access/
        try{
        	$this->db = new PDO(DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET, DB_USER, DB_PASS, $options);	
        }catch(PDOException $e){
        	exit("No tenemos accesible esa base de datos");
        }
        
	}

	public static function getInstance(){
		if(is_null(self::$instancia)){
			self::$instancia = new Database();
		}
		return self::$instancia;
	}

	public function getDatabase(){
		return $this->db;
	}
}

//$conn = Database::getInstance()->getDatabase();