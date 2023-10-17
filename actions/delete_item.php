<?php
require_once '../config/db_connect.php';
session_start();

$bookId = $_POST['bookId'];

// Delete the item from the shopping_cart table
$deleteQuery = "DELETE FROM shopping_cart WHERE book_id = $bookId";
if (mysqli_query($connect, $deleteQuery)) {
    echo "Item removed from the shopping cart";
} else {
    echo "Error removing item from the shopping cart: " . mysqli_error($connect);
}
