<?php
require_once '../config/db_connect.php';
session_start();

$bookId = $_POST['bookId'];
$quantity = $_POST['quantity'];


$updateQuery = "UPDATE shopping_cart SET quantity = $quantity WHERE   user_id = {$_SESSION["user"]} AND book_id = $bookId";

if (mysqli_query($connect, $updateQuery)) {
    $getPrice = "SELECT price FROM book WHERE id = $bookId";
    $priceResult = mysqli_query($connect, $getPrice);
    $row = mysqli_fetch_assoc($priceResult);
    $price = $row['price'];

    $itemTotal = $price * $quantity;

    $updateTotalQuery = "UPDATE shopping_cart SET total = $itemTotal WHERE  user_id = {$_SESSION["user"]} AND book_id = $bookId";
    mysqli_query($connect, $updateTotalQuery);

    echo "Quantity updated successfully";
} else {
    echo "Error updating quantity in the database: " . mysqli_error($connect);
}
