<?php
// headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: DELETE");
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
    (!empty($data->id) || ($data->id == "0"))
) {
    // set id
    $shopping_list_items->id = $data->id;

    // delete item
    if($shopping_list_items->delete()) {
        echo json_encode(
            array("message" => "Shopping_list_item deleted")
        );
    } else {
        echo json_encode(
            array("message" => "Shopping_list_item not deleted")
        );
    }
} else {
    // set response code - 400 bad request
    http_response_code(400);
  
    // incomplete data
    echo json_encode(array("message" => "Unable to delete shopping_list_item. Data is incomplete."));
}

?>