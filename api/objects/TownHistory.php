<?php

class TownHistory  {
    private $conn;

    public function __construct($db){
        $this->conn = $db;
    }

    function read(){
        $id = isset($_GET['town_id']) ? $_GET['town_id'] : null;

        $query = "
                SELECT office_name, address,working_hours FROM offices o
                JOIN offices_towns ot on o.id = ot.office_id
		        WHERE ot.town_id =   " .$id . "; ";

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt;
    }
}
?>