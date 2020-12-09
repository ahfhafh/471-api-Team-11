<?php
// headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: POST");
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

if (
    !empty($data->date) &&
    !empty($data->name) &&
    (!empty($data->item) || ($data->item == "0"))
) {
    $promotion->date = $data->date;
    $promotion->name = $data->name;
    $promotion->item = $data->item;

    // create promotion
    if($promotion->create()) {
        echo json_encode(
            array("message" => "Promotion created")
        );
    } else {
        echo json_encode(
            array("message" => "Promotion not created")
        );
    }
} else {
    // set response code - 400 bad request
    http_response_code(400);
  
    // incomplete data
    echo json_encode(array("message" => "Unable to create promotion. Data is incomplete."));
}

?>