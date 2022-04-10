<?php


if ($_FILES["path"]) {

    $filename = $_FILES["path"]["name"];
    $tempname = $_FILES["path"]["tmp_name"];
    $folder   = uniqid(true) . $filename;

    if (move_uploaded_file($tempname, "assets/images/" . $folder)) {
        $msg = "Image uploaded successfully";
        header("HTTP/1.1 200 OK");
        echo json_encode(["fileName" => $folder]);
    } else {
        $msg = "Failed to upload image";
        header("HTTP/1.1 502 Bad Gateway");
        echo json_encode(["error" => "file not uploaded"]);
    }
} else {
    header("HTTP/1.1 404 not Found");
}
