<?php
include 'controllers/user-controller.php';


$response = array();
if (isset($_FILES["picture"]) && $_FILES["picture"]["error"] == 0) {

    $uploadDir = "assets/img/"; 
    $uploadFile = $uploadDir . basename($_FILES["picture"]["name"]);
    if (move_uploaded_file($_FILES["picture"]["tmp_name"], $uploadFile)) {
        $response["success"] = true;
        $response["message"] = "File uploaded successfully.";
        $response["url"] = $uploadFile;
        
    } else {
        $response["success"] = false;
        $response["message"] = "Error uploading file.";
    }
}
echo json_encode($response);
