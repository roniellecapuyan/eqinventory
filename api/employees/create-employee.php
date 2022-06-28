<?php
include_once('../db.php');

try {
    $data = getPostData();
    $name = $data['name'];
    $type = $data['type'];
    $office = $data['office'];
    $active = $data['active'];

    $conn = getConn();
    $sql = "INSERT INTO `employees` (`id`, `name`, `type`, `office`, `active`) 
            VALUES (NULL, '$name', '$type', '$office', '$active')
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