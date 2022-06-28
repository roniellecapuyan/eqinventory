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
    $ris = $data['ris'];
    $stock = $data['stock'];
    $par = $data['par'];
    $ics = $data['ics'];
    $property = $data['property'];
    $status = $data['status'];
    $serial = $data['serial'];

    $conn = getConn();
    $sql = "UPDATE items SET 
                account= '$account',
                article= '$article',
                description= '$description',
                date= '$date',
                number= '$number',
                measurement= '$measurement',
                value= '$value',
                office= '$office',
                issued= '$issued',
                po= '$po',
                ris= '$ris',
                stock= '$stock',
                par= '$par',
                ics= '$ics',
                property= '$property',
                status= '$status',
                serial= '$serial'
                WHERE id='$id'
            ";
    $stmt = $conn->prepare($sql);
    $result = $stmt->execute();
    if($result == 1) {
        http_response_code(200);
    } else {
        http_response_code(400);
    }
} 
catch(Exception $error) {
    echo $error;
    http_response_code(400);
}
