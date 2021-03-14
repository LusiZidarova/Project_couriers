<?php

class VehicleHistory  {
    private $conn;

    public function __construct($db){
        $this->conn = $db;
    }

    function read(){
        $id = isset($_GET['vehicle_id']) ? $_GET['vehicle_id'] : null;
        $query = "SELECT v.datetime_start, 
                        v.datetime_end, 
                        e.user_number, 
                        e.full_name
                    from vehicles_employee_history v
                    JOIN employees e ON v.employee_id = e.id
                    WHERE v.vehicle_id = " . $id . "
                    ORDER BY v.datetime_start DESC, IFNULL(v.datetime_end, \"9999-01-01\") desc;";

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt;
    }
}
?>