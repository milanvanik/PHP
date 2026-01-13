<?php
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json");

include("../config/config.php");
$config = new Config();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['name'], $_POST['department_id'])) {
        $name = $_POST['name'];
        $id = $_POST['department_id'];

        $res = $config->insertMember($name, $id);

        if ($res) {
            http_response_code(201);
            $arr['status'] = 201;
            $arr['is_error'] = false;
            $arr['msg'] = 'member inserted successfully';
        } else {
            http_response_code(201);
            $arr['status'] = 201;
            $arr['is_error'] = true;
            $arr['msg'] = "Insertion Failed: Check if Department ID exists";
        }

    } else {
        http_response_code(500);
        $arr['status'] = 500;
        $arr['is_error'] = true;
        $arr['msg'] = "Name and department_id are required";
    }

} else {
    http_response_code(400);
    $arr['status'] = 400;
    $arr['is_error'] = true;
    $arr['msg'] = "POST HTTP Request Method Allowed Only";
}

echo json_encode($arr);

?>