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
  
// get ID
$admin->admin_id = isset($_GET['admin_id']) ? $_GET['admin_id'] : die();

// get admin
$admin->search();

// create array
$admin_arr = array(
'email' => $admin->email,
'admin_id' => $admin->admin_id,
);

// set response code - 200 OK
http_response_code(200);

// make JSON
print_r(json_encode($admin_arr));

?>