<?php
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json");

include("../config/config.php");
$config = new Config();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        $res = $config->fetchSingleStudent($id);

        if ($res) {
            $row = mysqli_fetch_assoc($res);

            if ($row) {
                http_response_code(200);
                $arr['status'] = 200;
                $arr['is_error'] = false;
                $arr['data'] = $row;
                $arr['msg'] = "Successfully fetched student info";
            } else {
                http_response_code(404);
                $arr['status'] = 404;
                $arr['is_error'] = true;
                $arr['msg'] = "Student not found";
            }
        } else {
            http_response_code(500);
            $arr['status'] = 500;
            $arr['is_error'] = true;
            $arr['msg'] = "Internal Server Error";
        }
    } else {
        http_response_code(400);
        $arr['status'] = 400;
        $arr['is_error'] = true;
        $arr['msg'] = "ID is required";
    }
} else {
    http_response_code(405);
    $arr['status'] = 405;
    $arr['is_error'] = true;
    $arr['msg'] = "POST HTTP Request Method Allowed Only";
}

echo json_encode($arr);
?>