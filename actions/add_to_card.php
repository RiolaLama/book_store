<?php
require_once '../config/db_connect.php';
session_start();


if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $query = "SELECT * FROM shopping_cart WHERE user_id = {$_SESSION["user"]} AND book_id =  $id ";
    $res = mysqli_query($connect, $query);
    if (mysqli_num_rows($res) > 0) {
        $row = mysqli_fetch_assoc($res);
        $_SESSION['qty'] = $row['quantity'] + 1;
        $sqlUpdate = "UPDATE `shopping_cart` SET `quantity`='{$_SESSION['qty']}' WHERE book_id = $id ";
        mysqli_query($connect, $sqlUpdate);
    } else {
        $sql1 = "INSERT INTO `shopping_cart`(`book_id`, `user_id`, `quantity`) VALUES ($id , {$_SESSION["user"]}, 1)";
        $_SESSION['qty'] = 1;
        $res1 =  mysqli_query($connect, $sql1);
    }
    header("Location: ../cart.php");
}
