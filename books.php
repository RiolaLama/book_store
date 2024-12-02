<?php
include 'controllers/user-controller.php';
$currentPage = 'show-books';
$title = "Books";

$result = getAllBooksWithAuthors();
$tbody = '';
if (mysqli_num_rows($result)  > 0) {
    foreach ($result as $row) {
        $tbody .= "
            <div class='col-lg-4 col-md-6 wow fadeInUp' data-wow-delay='0.1s'>
                <div class='store-item position-relative text-center w-75 m-auto'>
                    <img class='img-fluid image-card' src='assets/img/{$row['image']}' alt=''>
                    <div class='p-4'>
                        <h4 class='mb-3'>{$row['title']}</h4>
                        <p>{$row['short_description']}</p>
                        <p>$ {$row['price']}</p>
                        <h4 class='text-primary'>Author: {$row['first_name']} {$row['last_name']} </h4>
                    </div>
                    <div class='store-overlay'>
                        <a href='details.php?id={$row['id']}' class='btn btn-primary rounded-pill py-2 px-4 m-2'>More Detail <i class='fa fa-arrow-right ms-2'></i></a>
                        <form method='POST' class='addCard' action='actions/add_to_cart.php'>
                            <input type='text' hidden name='id' value='{$row['id']}'>
                            <button type='submit' name='submit' href='books.php?id={$row['id']}' class='btn btn-dark rounded-pill py-2 px-4 m-2'>Add to Cart <i class='fa fa-cart-plus ms-2'></i></button>
                        </form>
                    </div>
                </div>
            </div>
        ";
    }
} else {
    $tbody =  "<div><p>No Data Available </p></div>";
}

?>
<?php include('components/header.php'); ?>

<!-- Page Header Start -->
<div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container text-center py-5">
        <h1 class="display-2 text-dark mb-4 animated slideInDown">Books</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item "><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Pages</a></li>
                <li class="breadcrumb-item active text-dark " aria-current="page">Books</li>
            </ol>
        </nav>
    </div>
</div>
<!-- Page Header End -->

<!-- Books Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="section-title text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
            <p class="fs-5 fw-medium fst-italic text-primary">Online Store</p>
            <h1 class="display-6">Are you looking to nourish your mind ?</h1>
        </div>
        <div class="row g-4">
            <?= $tbody; ?>
        </div>
    </div>
</div>
<!-- Books End -->


<?php include('components/footer.php'); ?>