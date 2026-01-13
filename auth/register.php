<?php
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json");

include("../config/config.php");
$config = new Config();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['name'], $_POST['email'], $_POST['password'])) {

        
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $res = $config->registerUser( $name, $email, $hashed_password);

        if ($res) {
            http_response_code(201);
            $arr['status'] = 201;
            $arr['is_error'] = false;
            $arr['msg'] = "User registered successfully...";
        } else {
            http_response_code(500);
            $arr['status'] = 500;
            $arr['is_error'] = true;
            $arr['msg'] = "Registration failed";
        }
    } else {
        http_response_code(400);
        $arr['status'] = 400;
        $arr['is_error'] = true;
        $arr['msg'] = "All fields (name, email, password) are required";
    }
} else {
    http_response_code(405);
    $arr['status'] = 405;
    $arr['is_error'] = true;
    $arr['msg'] = "POST HTTP Request Method Allowed Only";
}

echo json_encode($arr);
?>