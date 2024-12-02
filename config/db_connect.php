<?php

$localhost = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "book-store";

try {
    $connect = mysqli_connect($localhost, $username, $password, $dbname);
    // echo "Connected successfully";
} catch (Exception $e) {
    echo $e->getMessage();
}


function cleanInput($param)
{
    $clean = trim($param);
    $clean = strip_tags($clean);
    $clean = htmlspecialchars($clean);

    return $clean;
}

function redirect($url, $message, $type = 'success')
{

    $_SESSION['message'] = $message;
    $_SESSION['type'] = $type;
    header("Location: " . $url);
    exit();
}
