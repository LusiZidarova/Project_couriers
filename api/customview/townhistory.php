<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../objects/TownHistory.php';

$database = new Database();
$db = $database->getConnection();

$townhistory = new TownHistory($db);

$stmt = $townhistory->read();
$num = $stmt->rowCount();

if($num>0){
    $town_history=array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $history_item=array(
            "office_name" => $office_name,
            "address" => $address,
            "working_hours" => $working_hours,
        );
        array_push($town_history, $history_item);
    }
    http_response_code(200);

    echo json_encode($town_history);
}
else{
    http_response_code(404);

    echo json_encode(
        array("message" => "Не са намерени записи.")
    );
}