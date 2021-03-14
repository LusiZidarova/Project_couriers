<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../objects/OfficeHistory.php';

$database = new Database();
$db = $database->getConnection();

$office_history[]=array();
$office_history['towns'] = array();
$office_history['employees'] = array();
$office_history['vehicles'] = array();

$officehistory = new OfficeHistory($db);

$stmtTowns = $officehistory->readTowns();
$numTowns = $stmtTowns->rowCount();

if($numTowns>0) {
    while ($row = $stmtTowns->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $history_item = array(
            "name" => $name
        );
        array_push($office_history['towns'], $history_item);
    }
}

$stmtEmployees = $officehistory->readEmployees();
$numEmployees = $stmtEmployees->rowCount();

if($numEmployees>0) {
    while ($row = $stmtEmployees->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $history_item = array(
            "full_name" => $full_name,
            "user_number" => $user_number,
        );
        array_push($office_history['employees'], $history_item);
    }
}

$stmtVehicles = $officehistory->readVehicles();
$numVehicles = $stmtVehicles->rowCount();

if($numVehicles>0) {
    while ($row = $stmtVehicles->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $history_item = array(
            "brand" => $brand,
            "model" => $model,
            "reg_number" => $reg_number,
            "user_number" =>$user_number,
            "employee_name" => $full_name,

        );
        array_push($office_history['vehicles'], $history_item);
    }
}

http_response_code(200);

echo json_encode($office_history);
