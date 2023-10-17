<?php

session_start();

$currentPath = $_SERVER['REQUEST_URI'];
$page = substr($_SERVER['SCRIPT_NAME'], strrpos($_SERVER['SCRIPT_NAME'], '/') + 1);
$baseUrl = '';
$path = 'users/';
$cssUrl = '';
$title = '';

if (strpos($currentPath, '/users/')) {
    $path = '';
}
if (strpos($currentPath, '/books/') || strpos($currentPath, '/genres/')) {
    $path = '../users/';
}
if (strpos($currentPath, '/books/') || strpos($currentPath, '/genres/') || strpos($currentPath, '/users/')) {
    $baseUrl = '../';
    $cssUrl = '../';
}
if (strpos($currentPath, '/actions/')) {
    $baseUrl = '../../';
    $cssUrl = '../../';
}

global $baseUrl;

include $baseUrl . 'controllers/admin-controller.php';


if (isset($_SESSION["admin"])) {
    $userType = "admin";
    $sql = "SELECT * FROM users WHERE id = {$_SESSION[$userType]}";
    $result = mysqli_query($connect, $sql);
    $user = mysqli_fetch_assoc($result);
    $_SESSION['fullName'] = "{$user['first_name']} {$user['last_name']}";
} elseif (isset($_SESSION["user"])) {
    redirect($baseUrl . "../index.php", "You are not authorized to access this page!");
} else if (!isset($_SESSION["admin"]) && !isset($_SESSION["user"])) {
    redirect($baseUrl . "../login.php", "Login to continue!");
}
