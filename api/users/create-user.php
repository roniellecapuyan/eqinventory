<?php
include_once('../db.php');

try {
    $data = getPostData();
    $username = $data['username'];
    $password = $data['password'];
    $name = $data['name'];

    $conn = getConn();
    $sql = "INSERT INTO users(username, password, name) 
            VALUES('$username', '$password', '$name')
        ";

    $stmt = $conn->prepare($sql);
    $result = $stmt->execute();
    if($result == 1) {
        http_response_code(200);
    } else {
        http_response_code(400);
    }
}
catch (Exception $error) {
    echo $error;
    http_response_code(400);
}