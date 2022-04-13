<?php



if ($_FILES["path"]) {
    $path = "";

    $filename = $_FILES["path"]["name"];
    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    $tempName = $_FILES["path"]["tmp_name"];
    $path   = uniqid(true) . "." . $ext;


    header("HTTP/1.1 200 OK");
    echo json_encode($path);
}
