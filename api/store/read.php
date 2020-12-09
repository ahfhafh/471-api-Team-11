<?php
// headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/store.php';
  
// instantiate database
$database = new Database();
$db = $database->connect();
  
// initialize object
$store = new store($db);
  
// query products
$stmt = $store->read();
$num = $stmt->rowCount();
  
// check if record found
if($num > 0){
  
    // products array
    $stores_arr=array();
    $stores_arr["data"]=array();
  
    // retrieve our table contents
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        extract($row);
  
        $store_store=array(
            "store_id" => $store_id,
            "location" => $location,
            "name" => $name
        );
  
        array_push($stores_arr["data"], $store_store);
    }
  
    // set response code - 200 OK
    http_response_code(200);
  
    // show products data in json format
    echo json_encode($stores_arr);
}
  
else{
  
    // set response code - 404 Not found
    http_response_code(404);
  
    // no products found
    echo json_encode(
        array("message" => "No stores found.")
    );
}