<?php
include 'controllers/user-controller.php';
$currentPage = 'cart';
$title = "Shopping Cart";

$sql = "SELECT * FROM users WHERE id = {$_SESSION[$userType]}";

$result = mysqli_query($connect, $sql);
$user = mysqli_fetch_assoc($result);
$userId = $_SESSION[$userType];



$tbody = '';
$total = 0;
$totalCart = 0;
$query0 = "SELECT * FROM shopping_cart WHERE user_id = $userId";
$res0 = mysqli_query($connect, $query0);
if (mysqli_num_rows($res0) > 0) {

    $query = "SELECT * FROM shopping_cart JOIN book ON shopping_cart.book_id = book.id WHERE user_id = $userId";
    $result2 = mysqli_query($connect, $query);

    while ($row = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
        $itemTotal = round($row['price'] * $row['quantity'], 2);
        $queryUpdateTotal = "UPDATE shopping_cart SET total = $itemTotal WHERE user_id = $userId AND book_id = {$row['book_id']}";
        mysqli_query($connect, $queryUpdateTotal);
        $totalCart += $itemTotal;
        $tbody .= "
            <tr>
                <th scope='row'>
                    <div class='d-flex align-items-center'>
                        <img src='assets/img/{$row['image']}' class='img-fluid rounded-3' style='width: 120px;' alt='Book'>
                        <div class='flex-column ms-4'>
                            <p class='mb-2'>{$row['title']}</p>
                            <p class='mb-0'> {$row['author_first_name']} {$row['author_last_name']} </p>
                        </div>
                    </div>
                </th>
                <td class='align-middle'>
                    <p class='mb-0' style='font-weight: 500;'>Digital</p>
                </td>
                <td class='align-middle'>
                <p class='mb-0' style='font-weight: 500;' data-price='{$row['price']}'>$ {$row['price']}</p>
                </td>
                <td class='align-middle'>
                    <div class='d-flex flex-row'>
                        <button class='btn btn-link px-2 minusBtn' data-bookid='{$row['book_id']}'>
                        <i class='fas fa-minus'></i>
                        </button>
                        <input id='qtyValue' min='0' name='quantity' value='{$row['quantity']}' type='number' class='form-control form-control-sm qtyValue' style='width: 50px;' />
                        <button class='btn btn-link px-2 plusBtn' data-bookid='{$row['book_id']}'>
                            <i class='fas fa-plus'></i>
                        </button>
                    </div>
                </td>
               
                <td class='align-middle'>
                <p class='mb-0 total' style='font-weight: 500;' data-price='{$row['price']}'> $ $itemTotal</p>
                </td>
            </tr>
    ";
    }
} else {
    $tbody = "<h2 class='text-center my-5'>Shopping cart is empty</h2>";
}

?>
<?php include('components/header.php'); ?>

<!-- Page Header Start -->
<div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container text-center py-5">
        <h1 class="display-2 text-dark mb-4 animated slideInDown">Shopping Cart</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item "><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Pages</a></li>
                <li class="breadcrumb-item active text-dark" aria-current="page">Cart</li>
            </ol>
        </nav>
    </div>
</div>
<!-- Page Header End -->
<!-- Article Start -->
<div class="container-xxl py-5">
    <!-- Shoping Cart Section Begin -->
    <section class="h-100 h-custom">
        <div class="container h-100 py-5">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col">

                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col" class="h5">Shopping Bag</th>
                                    <th scope="col">Format</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?= $tbody ?>
                            </tbody>
                        </table>
                        <div class='text-end'>
                            <p class='fw-bold mb-0' id='totalCart'>TOTAL: $<?= $totalCart ?> </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shoping Cart Section End -->
</div>
<!-- Article End -->

<?php require_once 'components/footer.php' ?>