<?php
// headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PUT");
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

// set store_id of the store to be edited
$store->store_id = $data->store_id;

$store->location = $data->location;
$store->name = $data->name;

// update store
if($store->update()) {
    echo json_encode(
        array("message" => "Store updated")
    );
} else {
    echo json_encode(
        array("message" => "Store not updated")
    );
}

?>