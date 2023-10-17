<?php

include $baseUrl.'../config/db_connect.php';
include $baseUrl.'../components/file_upload.php';


function redirect($url, $message, $type = 'success'){

    $_SESSION['message'] = $message;
    $_SESSION['type'] = $type;
    header("Location: " . $url);
    exit();
}

function getAll($table)
{
    global $connect;
    $sql = "SELECT * FROM $table";
    return mysqli_query($connect, $sql);
}

function getById($table, $id)
{
    global $connect;
    $sql = "SELECT * FROM $table WHERE id = {$id}";
    return mysqli_query($connect, $sql);
}

function getUsersByStatus($table, $status)
{
    global $connect;
    $sql = "SELECT * FROM $table WHERE user_type != '$status'";
    return mysqli_query($connect, $sql);
}

function countRecords($table)
{
    global $connect;
    $sql = "SELECT COUNT(*) AS count FROM $table";
    return mysqli_query($connect, $sql);
}