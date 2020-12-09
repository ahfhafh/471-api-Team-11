<?php
// headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Authorization, Access-Control-Allow-Methods, X-Requested-With");

// include database and object files
include_once '../config/database.php';
include_once '../objects/item.php';

// instantiate database
$database = new Database();
$db = $database->connect();

// initialize object
$item = new item($db);

// get data
$data = json_decode(file_get_contents("php://input"));


if (
    (!empty($data->item_id) || ($data->item_id == "0"))
) {
    // set item_id
    $item->item_id = $data->item_id;

    // delete item
    if($item->delete()) {
        echo json_encode(
            array("message" => "Item deleted")
        );
    } else {
        echo json_encode(
            array("message" => "Item not deleted")
        );
    }
} else {
    // set response code - 400 bad request
    http_response_code(400);
  
    // incomplete data
    echo json_encode(array("message" => "Unable to delete item. Data is incomplete."));
}

?>