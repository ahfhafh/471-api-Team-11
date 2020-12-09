<?php
// headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Authorization, Access-Control-Allow-Methods, X-Requested-With");

// include database and object files
include_once '../config/database.php';
include_once '../objects/discount.php';

// instantiate database
$database = new Database();
$db = $database->connect();

// initialize object
$discount = new discount($db);

// get data
$data = json_decode(file_get_contents("php://input"));

if (
    !empty($data->name) &&
    !empty($data->owner) &&
    !empty($data->date_end) &&
    (!empty($data->store) || ($data->store == "0")) &&
    (!empty($data->item_id) || ($data->item_id == "0"))
) {
    $discount->name = $data->name;
    $discount->store = $data->store;
    $discount->owner = $data->owner;
    $discount->item_id = $data->item_id;
    $discount->date_end = $data->date_end;

    // create discount
    if($discount->create()) {
        echo json_encode(
            array("message" => "Discount created")
        );
    } else {
        echo json_encode(
            array("message" => "Discount not created")
        );
    }
} else {
    // set response code - 400 bad request
    http_response_code(400);
  
    // incomplete data
    echo json_encode(array("message" => "Unable to create discount. Data is incomplete."));
}

?>