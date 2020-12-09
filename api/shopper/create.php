<?php
// headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Authorization, Access-Control-Allow-Methods, X-Requested-With");

// include database and object files
include_once '../config/database.php';
include_once '../objects/shopper.php';

// instantiate database
$database = new Database();
$db = $database->connect();

// initialize object
$shopper = new shopper($db);

// get data
$data = json_decode(file_get_contents("php://input"));

if (
    !empty($data->username)
) {
    $shopper->username = $data->username;
    $shopper->lists = $data->lists;
    $shopper->shopper_email = $data->shopper_email;

    // create shopper
    if($shopper->create()) {
        echo json_encode(
            array("message" => "Shopper created")
        );
    } else {
        echo json_encode(
            array("message" => "Shopper not created")
        );
    }
} else {
    // set response code - 400 bad request
    http_response_code(400);
  
    // incomplete data
    echo json_encode(array("message" => "Unable to create shopper. Data is incomplete."));
}

?>