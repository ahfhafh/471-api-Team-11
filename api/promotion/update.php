<?php
// headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Authorization, Access-Control-Allow-Methods, X-Requested-With");

// include database and object files
include_once '../config/database.php';
include_once '../objects/promotion.php';

// instantiate database
$database = new Database();
$db = $database->connect();

// initialize object
$promotion = new promotion($db);

// get data
$data = json_decode(file_get_contents("php://input"));

// set promotion_id of the promotion to be edited
$promotion->promotion_id = $data->promotion_id;

$promotion->item = $data->item;
$promotion->name = $data->name;
$promotion->date = $data->date;

// update promotion
if($promotion->update()) {
    echo json_encode(
        array("message" => "Promotion updated")
    );
} else {
    echo json_encode(
        array("message" => "Promotion not updated")
    );
}

?>