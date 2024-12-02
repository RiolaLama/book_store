<?php
include 'controllers/user-controller.php';

$currentPage = 'cart';
$title = "Shopping Cart";

$userId = $_SESSION[$userType];
$query = "DELETE FROM shopping_cart WHERE user_id = {$_SESSION["user"]}";
mysqli_query($connect, $query);

$tbody = '';
$total = 0;
$totalCart = 0;
$query0 = "SELECT * FROM shopping_cart WHERE user_id = $userId";
$res0 = mysqli_query($connect, $query0);
if (mysqli_num_rows($res0) > 0) {

    $query = "SELECT * FROM shopping_cart 
          JOIN book ON shopping_cart.book_id = book.id
          LEFT JOIN books_authors ON book.id = books_authors.book_id
          LEFT JOIN authors ON books_authors.author_id = authors.id
          WHERE shopping_cart.user_id = $userId
          GROUP BY book.id";
    $result2 = mysqli_query($connect, $query);

    while ($row = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
        $itemTotal = round($row['price'] * $row['quantity'], 2);
        $queryUpdateTotal = "UPDATE shopping_cart SET total = $itemTotal WHERE user_id = $userId AND book_id = {$row['book_id']}";
        mysqli_query($connect, $queryUpdateTotal);
        $totalCart += $itemTotal;
    }
} else {
    $tbody = "<h2 class='text-center my-5'>Shopping cart is empty</h2>";
}

?>
<?php include('components/header.php'); ?>

<!-- Page Header Start -->
<div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container text-center py-5">
        <h1 class="display-2 text-dark mb-4 animated slideInDown">Orders</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item "><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Pages</a></li>
                <li class="breadcrumb-item active text-dark" aria-current="page">Orders</li>
            </ol>
        </nav>
    </div>
</div>
<!-- Page Header End -->
<!-- Article Start -->
<div class="container-xxl py-5">
    <!-- Order Section Begin -->
    <h1 class="text-center">Order completed</h1>
    <!-- Order Section End -->
</div>
<!-- Article End -->

<?php require_once 'components/footer.php' ?>