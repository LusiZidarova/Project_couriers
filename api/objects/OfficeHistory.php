<?php
class OfficeHistory  {

    private $conn;

    public function __construct($db){
        $this->conn = $db;
    }

	function readTowns(){
        $id = isset($_GET['office_id']) ? $_GET['office_id'] : null;

		$query = "SELECT t.name FROM offices o
                  JOIN offices_towns ot on o.id = ot.office_id
                  JOIN towns t ON t.id= ot.town_id 
	              WHERE ot.office_id = " . $id . ";";

		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		return $stmt;
	}

    function readEmployees(){
        $id = isset($_GET['office_id']) ? $_GET['office_id'] : null;

        $query = "
                SELECT full_name,user_number FROM employees e
                JOIN offices o  on o.id = e.office_id
		        WHERE e.office_id =   " .$id . "; ";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    function readVehicles(){
        $id = isset($_GET['office_id']) ? $_GET['office_id'] : null;

        $query = "
                SELECT brand,  model, reg_number, e.user_number, e.full_name FROM vehicles v
                JOIN employees e on v.employee_id = e.id
                JOIN offices o  on o.id = e.office_id
		        WHERE v.office_id =   " .$id . "; ";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
}
?>