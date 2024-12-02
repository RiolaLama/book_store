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
    $userType = "admin";
} else if (!isset($_SESSION["admin"]) && !isset($_SESSION["user"])) {
    redirect($baseUrl . "login.php", "Login to continue!");
}


function getAll($table)
{
    global $connect;
    $sql = "SELECT * FROM $table";
    return mysqli_query($connect, $sql);
}

function getAllBooksWithAuthors()
{
    global $connect;
    $sql = "SELECT b.*, a.first_name, a.last_name
            FROM book AS b
            LEFT JOIN books_authors AS ba ON b.id = ba.book_id
            LEFT JOIN authors AS a ON ba.author_id = a.id";

    $stmt = $connect->prepare($sql);
    $stmt->execute();
    return $stmt->get_result();
}

function getById($table, $id)
{
    global $connect;
    $sql = "SELECT b.*, a.first_name, a.last_name, a.email, g.name AS genre_name
    FROM {$table} b
    LEFT JOIN books_authors ba ON b.id = ba.book_id
    LEFT JOIN authors a ON ba.author_id = a.id
    LEFT JOIN genres g ON b.genre_id = g.id
    WHERE b.id = ?";

    $stmt = $connect->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    return $stmt->get_result();
}

function getMoreBooks($table, $id)
{
    global $connect;
    $sql = "SELECT * FROM {$table} WHERE id != ?";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    return $stmt->get_result();
}

function getLimitedBooksWithAuthors($limit = 7)
{
    global $connect;
    $sql = "SELECT b.*, a.first_name, a.last_name
            FROM book AS b
            LEFT JOIN books_authors AS ba ON b.id = ba.book_id
            LEFT JOIN authors AS a ON ba.author_id = a.id
            LIMIT ?";

    $stmt = $connect->prepare($sql);
    $stmt->bind_param("i", $limit);
    $stmt->execute();

    return $stmt->get_result();
}

function getUserProfile($userId)
{
    global $connect;
    $sql = "SELECT * FROM users 
            JOIN address_code ON users.address_code_id = address_code.id 
            WHERE users.id = ?";

    $stmt = $connect->prepare($sql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();

    return $stmt->get_result()->fetch_assoc();
}
