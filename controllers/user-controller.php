<?php
include 'config/db_connect.php';
include 'components/file_upload.php';
session_start();
$currentPath = $_SERVER['REQUEST_URI'];
$page = substr($_SERVER['SCRIPT_NAME'], strrpos($_SERVER['SCRIPT_NAME'], '/') + 1);
$baseUrl = '';
$path = 'users/';
$cssUrl = '';
$title = '';

// if (strpos($currentPath, '/users/')) {
//     $path = '';
// }
// if (strpos($currentPath, '/books/') || strpos($currentPath, '/genres/')) {
//     $path = '../users/';
// }
// if (strpos($currentPath, '/books/') || strpos($currentPath, '/genres/') || strpos($currentPath, '/users/')) {
//     $baseUrl = '../';
//     $cssUrl = '../';
// }
// if (strpos($currentPath, '/actions/')) {
//     $baseUrl = '../../';
//     $cssUrl = '../../';
// }


// include $baseUrl . 'controllers/admin-controller.php';
global $connect;

if (isset($_SESSION["user"])) {
    $userType = "user";
    $sql = "SELECT * FROM users WHERE id = {$_SESSION[$userType]}";
    $result = mysqli_query($connect, $sql);
    $user = mysqli_fetch_assoc($result);
    $_SESSION['fullName'] = "{$user['first_name']} {$user['last_name']}";
} elseif (isset($_SESSION["admin"])) {
    redirect($baseUrl . "admin/dashboard.php", "You are not authorized to access this page!");
} else if (!isset($_SESSION["admin"]) && !isset($_SESSION["user"])) {
    redirect($baseUrl . "login.php", "Login to continue!");
}


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

function getMoreBooks($table, $id){
    global $connect;
    $sql = "SELECT * FROM $table WHERE id != {$id}";
    return mysqli_query($connect, $sql);
}