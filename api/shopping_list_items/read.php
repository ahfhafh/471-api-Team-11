<?php
// headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/shopping_list_items.php';
  
// instantiate database
$database = new Database();
$db = $database->connect();
  
// initialize object
$shopping_list_items = new shopping_list_items($db);
  
// query products
$stmt = $shopping_list_items->read();
$num = $stmt->rowCount();
  
// check if record found
if($num > 0){
  
    // products array
    $shopping_list_itemss_arr=array();
    $shopping_list_itemss_arr["data"]=array();
  
    // retrieve our table contents
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        extract($row);
  
        $shopping_list_items_shopping_list_items=array(
            "id" => $id,
            "item_id" => $item_id,
            "list_id" => $list_id
        );
  
        array_push($shopping_list_itemss_arr["data"], $shopping_list_items_shopping_list_items);
    }
  
    // set response code - 200 OK
    http_response_code(200);
  
    // show products data in json format
    echo json_encode($shopping_list_itemss_arr);
}
  
else{
  
    // set response code - 404 Not found
    http_response_code(404);
  
    // no products found
    echo json_encode(
        array("message" => "No shopping_list_items found.")
    );
}