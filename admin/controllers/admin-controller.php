<?php

include $baseUrl . '../config/db_connect.php';
include $baseUrl . '../components/file_upload.php';

function getAll($table)
{
    global $connect;
    $sql = "SELECT * FROM $table";
    return mysqli_query($connect, $sql);
}

function getById($table, $id)
{
    global $connect;
    $sql = '';
    if ($table == 'book') {
        $sql = "SELECT b.*, a.first_name, a.last_name, a.email, g.name AS genre_name
        FROM {$table} b
        LEFT JOIN books_authors ba ON b.id = ba.book_id
        LEFT JOIN authors a ON ba.author_id = a.id
        LEFT JOIN genres g ON b.genre_id = g.id
        WHERE b.id = ?";
    } elseif ($table == 'genres') {
        $sql = "SELECT g.*
        FROM {$table} g
        WHERE g.id = ?";
    }

    $stmt = $connect->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    return $stmt->get_result();
}

// function getUsersByStatus($table, $status)
// {
//     global $connect;
//     $sql = "SELECT * FROM $table WHERE user_type != '$status'";
//     return mysqli_query($connect, $sql);
// }

function countRecords($table)
{
    global $connect;
    $sql = "SELECT COUNT(*) AS count FROM $table";
    return mysqli_query($connect, $sql);
}
