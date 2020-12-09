<?php
// headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Authorization, Access-Control-Allow-Methods, X-Requested-With");

// include database and object files
include_once '../config/database.php';
include_once '../objects/store.php';

// instantiate database
$database = new Database();
$db = $database->connect();

// initialize object
$store = new store($db);

// get data
$data = json_decode(file_get_contents("php://input"));


if (
    (!empty($data->store_id) || ($data->store_id == "0"))
) {
    // set store_id
    $store->store_id = $data->store_id;

    // delete store
    if($store->delete()) {
        echo json_encode(
            array("message" => "Store deleted")
        );
    } else {
        echo json_encode(
            array("message" => "Store not deleted")
        );
    }
} else {
    // set response code - 400 bad request
    http_response_code(400);
  
    // incomplete data
    echo json_encode(array("message" => "Unable to delete store. Data is incomplete."));
}

?>