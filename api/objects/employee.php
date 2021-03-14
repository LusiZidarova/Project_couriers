<?php
class Employee{
    private $conn;
    private $table_name = "employee";
  
    // object properties
    public $employee_id;
    public $username;
    public $password;
    public $fullname;
    public $phone;
    public $office_id;

    public function __construct($db){
        $this->conn = $db;
    }

	function read(){
		$employee_id = isset($_GET['employee_id']) ? $_GET['employee_id'] : null;

		$query = "SELECT employee_id, number, username, password, fullname, phone, office_id FROM " . $this->table_name . " e";
		if ($employee_id == null)
			$query = $query . ";";
		else
			$query = $query . " where e.employee_id = " . $employee_id . ";";

		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		return $stmt;
	}
}
?>