<?php
// headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: DELETE");
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
    (!empty($data->promotion_id) || ($data->promotion_id == "0"))
) {
    // set promotion_id
    $promotion->promotion_id = $data->promotion_id;

    // delete promotion
    if($promotion->delete()) {
        echo json_encode(
            array("message" => "Promotion deleted")
        );
    } else {
        echo json_encode(
            array("message" => "Promotion not deleted")
        );
    }
} else {
    // set response code - 400 bad request
    http_response_code(400);
  
    // incomplete data
    echo json_encode(array("message" => "Unable to delete promotion. Data is incomplete."));
}

?>