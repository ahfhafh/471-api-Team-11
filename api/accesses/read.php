<?php
// headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/accesses.php';
  
// instantiate database
$database = new Database();
$db = $database->connect();
  
// initialize object
$accesses = new accesses($db);
  
// query products
$stmt = $accesses->read();
$num = $stmt->rowCount();
  
// check if record found
if($num > 0){
  
    // products array
    $accessess_arr=array();
    $accessess_arr["data"]=array();
  
    // retrieve our table contents
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        extract($row);
  
        $accesses_accesses=array(
            "accesses_id" => $accesses_id,
            "admin_id" => $admin_id,
            "store_id" => $store_id,
            "item_obtained" => $item_obtained,
        );
  
        array_push($accessess_arr["data"], $accesses_accesses);
    }
  
    // set response code - 200 OK
    http_response_code(200);
  
    // show products data in json format
    echo json_encode($accessess_arr);
}else{
  
    // set response code - 404 Not found
    http_response_code(404);
  
    // no products found
    echo json_encode(
        array("message" => "No accessess found.")
    );
}