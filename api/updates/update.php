<?php
// headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Authorization, Access-Control-Allow-Methods, X-Requested-With");

// include database and object files
include_once '../config/database.php';
include_once '../objects/updates.php';

// instantiate database
$database = new Database();
$db = $database->connect();

// initialize object
$updates = new updates($db);

// get data
$data = json_decode(file_get_contents("php://input"));

// set updates_id of the updates to be edited
$updates->item_added = $data->item_added;

$updates->admin_id = $data->admin_id;
$updates->inventory = $data->inventory;


// update updates
if($updates->update()) {
    echo json_encode(
        array("message" => "Updates updated")
    );
} else {
    echo json_encode(
        array("message" => "Updates not updated")
    );
}
