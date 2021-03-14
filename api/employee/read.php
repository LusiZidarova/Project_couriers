<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../objects/employee.php';

$database = new Database();
$db = $database->getConnection();

$employee = new Employee($db);

$stmt = $employee->read();
$num = $stmt->rowCount();

if($num>0){
    $employees=array();
    $employees_arr["records"]=array();
  
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
  
        $employee_item=array(
            "employee_id" => $employee_id,
            "number" => $number,
            "username" => $username,
            "password" => $password,
            "fullname" => $fullname,
            "phone" => $phone,
			"office_id" => $office_id
        );
  
        array_push($employees_arr["records"], $employee_item);
    }

    http_response_code(200);

    echo json_encode($employees_arr);
}
else{
    http_response_code(404);

    echo json_encode(
        array("message" => "No products found.")
    );
}