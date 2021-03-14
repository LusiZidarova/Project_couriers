<?php
class Town  {
    private $table_name = "towns";
    private $conn;

    // object properties
    public $id;
    public $name;

    public function __construct($db){
        $this->conn = $db;
    }

	function read(){
		$id = isset($_GET['id']) ? $_GET['id'] : null;

		$query = "SELECT id, name FROM " . $this->table_name . " t";
		if ($id == null)
			$query = $query . ";";
		else
			$query = $query . " where t.id = " . $id . ";";

		$stmt = $this->conn->prepare($query);

		$stmt->execute();
	  
		return $stmt;
	}
}
?>