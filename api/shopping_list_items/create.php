<?php
// headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Authorization, Access-Control-Allow-Methods, X-Requested-With");

// include database and object files
include_once '../config/database.php';
include_once '../objects/shopping_list_items.php';

// instantiate database
$database = new Database();
$db = $database->connect();

// initialize object
$shopping_list_items = new shopping_list_items($db);

// get data
$data = json_decode(file_get_contents("php://input"));

if (
    (!empty($data->item_id) || ($data->item_id == "0")) &&
    (!empty($data->list_id) || ($data->list_id == "0"))
) {
    $shopping_list_items->item_id = $data->item_id;
    $shopping_list_items->list_id = $data->list_id;

    // create shopping_list_item
    if($shopping_list_items->create()) {
        echo json_encode(
            array("message" => "Shopping_list_item created")
        );
    } else {
        echo json_encode(
            array("message" => "Shopping_list_item not created")
        );
    }
} else {
    // set response code - 400 bad request
    http_response_code(400);
  
    // incomplete data
    echo json_encode(array("message" => "Unable to create shopping_list_item. Data is incomplete."));
}

?>