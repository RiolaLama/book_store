<?php
require_once '../config/db_connect.php';
session_start();
    $query = "DELETE FROM shopping_cart WHERE user_id = {$_SESSION["user"]}";

    if(mysqli_query($connect, $query)) {
        http_response_code(200); 
        echo "Cart cleared successfully.";
    } else {
        http_response_code(500);
        echo "Error clearing the cart: " . mysqli_error($connect);
    }

mysqli_close($connect);
?>
