<?php
class Office  {

    private $table_name = "offices";
    private $conn;
    public $id;

    public function __construct($db){
        $this->conn = $db;
    }

	function read(){
        $id = isset($_GET['id']) ? $_GET['id'] : null;

		$query = "SELECT id, office_name FROM " . $this->table_name . " o";
        $query = $query." JOIN offices_towns ot on o.id = ot.office_id";
		if ($id == null)
			$query = $query . ";";
		else
			$query = $query . " where ot.town_id = " . $id . ";";

		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		return $stmt;
	}
}
?>