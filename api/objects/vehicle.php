<?php
class Vehicle{
    private $conn;
    private $table_name = "vehicle";
  
    // object properties
    public $vehicle_id;
    public $brand;
    public $model;
    public $regnumber;
    public $fuelconsumption;
    public $office_id;
    public $employee_id;

    public function __construct($db){
        $this->conn = $db;
    }

	function get(){
		$vehicle_id = isset($_GET['vehicle_id']) ? $_GET['vehicle_id'] : null;

		$query = "SELECT vehicle_id, brand, model, regnumber, fuelconsumption, office_id, employee_id FROM " . $this->table_name . " e";
		if ($vehicle_id == null)
			$query = $query . ";";
		else
			$query = $query . " where e.vehicle_id = " . $vehicle_id . ";";

		$stmt = $this->conn->prepare($query);

		$stmt->execute();
	  
		return $stmt;
	}

	function createOrUpdate(){
		$query = "CALL insert_Or_Update_Vehicle(:vehicle_id, :brand, :model, :regnumber, :fuelconsumption, :office_id, :employee_id);";

		$stmt = $this->conn->prepare($query);

		$this->brand=htmlspecialchars(strip_tags($this->brand));
		$this->model=htmlspecialchars(strip_tags($this->model));
		$this->regnumber=htmlspecialchars(strip_tags($this->regnumber));
		$this->fuelconsumption=htmlspecialchars(strip_tags($this->fuelconsumption));
		$this->office_id=htmlspecialchars(strip_tags($this->office_id));
		$this->employee_id=htmlspecialchars(strip_tags($this->employee_id));

		$stmt->bindParam(":vehicle_id", $this->vehicle_id);
		$stmt->bindParam(":brand", $this->brand);
		$stmt->bindParam(":model", $this->model);
		$stmt->bindParam(":regnumber", $this->regnumber);
		$stmt->bindParam(":fuelconsumption", $this->fuelconsumption);
		$stmt->bindParam(":office_id", $this->office_id);
		$stmt->bindParam(":employee_id", $this->employee_id);

		if($stmt->execute()){
			return true;
		}
	 
		return false;
	}

	function delete(){
		$query = "CALL delete_Vehicle(:vehicle_id);";

		$stmt = $this->conn->prepare($query);

		$this->vehicle_id=htmlspecialchars(strip_tags($this->vehicle_id));

		$stmt->bindParam(":vehicle_id", $this->vehicle_id);

		if($stmt->execute()){
			return true;
		}
	 
		return false;
	}
}
?>