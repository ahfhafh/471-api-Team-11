<?php
// headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/admin.php';
  
// instantiate database
$database = new Database();
$db = $database->connect();
  
// initialize object
$admin = new admin($db);
  
// query products
$stmt = $admin->read();
$num = $stmt->rowCount();
  
// check if record found
if($num > 0){
  
    // products array
    $admin_arr=array();
    $admin_arr["data"]=array();
  
    // retrieve our table contents
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        extract($row);
  
        $admin_admin=array(
            "admin_id" => $admin_id,
            "email" => $email,
        );
  
        array_push($admin_arr["data"], $admin_admin);
    }
  
    // set response code - 200 OK
    http_response_code(200);
  
    // show products data in json format
    echo json_encode($admin_arr);
}else{
  
    // set response code - 404 Not found
    http_response_code(404);
  
    // no products found
    echo json_encode(
        array("message" => "No admin found.")
    );
}

?>