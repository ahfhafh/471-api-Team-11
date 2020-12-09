<?php
// headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/updates.php';
  
// instantiate database
$database = new Database();
$db = $database->connect();
  
// initialize object
$updates = new updates($db);
  
// query products
$stmt = $updates->read();
$num = $stmt->rowCount();
  
// check if record found
if($num > 0){
  
    // products array
    $updates_arr=array();
    $updates_arr["data"]=array();
  
    // retrieve our table contents
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        extract($row);
  
        $updates_updates=array(
            "item_added" => $item_added,
            "admin_id" => $admin_id,
            "inventory" => $inventory
        );
  
        array_push($updates_arr["data"], $updates_updates);
    }
  
    // set response code - 200 OK
    http_response_code(200);
  
    // show products data in json format
    echo json_encode($updates_arr);
}else{
  
    // set response code - 404 Not found
    http_response_code(404);
  
    // no products found
    echo json_encode(
        array("message" => "No Updates found.")
    );
}