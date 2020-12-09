<?php
// headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PUT");
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

// set discount_id of the discount to be edited
$discount->discount_id = $data->discount_id;

$discount->store = $data->store;
$discount->name = $data->name;
$discount->owner = $data->owner;
$discount->item_id = $data->item_id;
$discount->date_end = $data->date_end;

// update discount
if($discount->update()) {
    echo json_encode(
        array("message" => "Discount updated")
    );
} else {
    echo json_encode(
        array("message" => "Discount not updated")
    );
}

?>