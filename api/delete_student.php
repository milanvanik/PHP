<?php
header("Access-Control-Allow-Methods: DELETE");
header("Content-Type: application/json");
include("../config/config.php");
$config = new Config();

if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    $input = file_get_contents('php://input'); // returns a string ("id = 101")
    parse_str($input, $_DELETE); // string to url query and saves in variable $_DELETE
    $id = $_DELETE['id'];
    $res = $config->deleteStud($id);

    if ($res) {
        http_response_code(response_code: 200);
        $arr['status'] = 200;
        $arr['is_error'] = false;
        $arr['msg'] = "Student deleted successfully";
    } else {
        http_response_code(response_code: 400);
        $arr['status'] = 400;
        $arr['is_error'] = true;
        $arr['msg'] = "Student deletion failed";
    }
} else {
    http_response_code(response_code: 405);
    $arr['status'] = 405;
    $arr['is_error'] = false;
    $arr['msg'] = "DELETE HTTP Request Method Allowed Only";
}

echo json_encode($arr);
?>