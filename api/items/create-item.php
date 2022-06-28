<?php
include_once('../db.php');

try {
    $data = getPostData();
    $account = $data['account'];
    $article = $data['article'];
    $description = $data['description'];
    $date = $data['date'];
    $number = $data['number'];
    $measurement = $data['measurement'];
    $value = $data['value'];
    $office = $data['office'];
    $issued = $data['issued'];
    $po = $data['po'];
    $status = $data['status'];
    $serial = $data['serial'];
    $ris = $data['ris'];
    $stock = $data['stock'];
    $par = $data['par'];
    $ics = $data['ics'];
    $property = $data['property'];

    $conn = getConn();
    $sql = "INSERT INTO `items` (id, account, article, description, date, number, measurement, value, office, issued, po, status, serial ris, stock, par, ics, property) 
            VALUES (NULL, '$account', '$article', '$description', '$date', '$number', '$measurement', '$value', '$office', '$issued', '$po', '$status', '$serial' '$ris', '$stock', '$par', '$ics', '$property')
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