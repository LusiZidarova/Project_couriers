<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../objects/VehicleHistory.php';

$database = new Database();
$db = $database->getConnection();

$vehiclehistory = new VehicleHistory($db);

$stmt = $vehiclehistory->read();
$num = $stmt->rowCount();

if($num>0){
    $vehicle_history=array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $history_item=array(
            "datetimestart" => $datetime_start,
            "datetimeend" => $datetime_end,
            "employeenumber" => $user_number,
            "employeename" => $full_name
        );
        array_push($vehicle_history, $history_item);
    }

    http_response_code(200);

    echo json_encode($vehicle_history);
}
else{
    http_response_code(404);

    echo json_encode(
        array("message" => "Не са намерени записи.")
    );
}