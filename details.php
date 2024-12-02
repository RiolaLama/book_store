<?php
include 'controllers/user-controller.php';
$currentPage = 'book-details';
$title = "Book Details";
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$result1 = getById('book', $id);
$row = mysqli_fetch_assoc($result1);
$bookItem = '';
$result2 = getMoreBooks('book', $id);
if (mysqli_num_rows($result2)  > 0) {
    foreach ($result2 as $book) {
        $bookItem .= "
            <div class='swiper-slide'>
                <a href='details.php?id={$book['id']}'> <img src='assets/img/{$book['image']}' /></a>
            </div>
        ";
    }
}
?>
<?php include('components/header.php') ?>
<!-- Page Header Start -->
<div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container text-center py-5">
        <h1 class="display-2 text-dark mb-4 animated slideInDown">Book Details</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item "><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Pages</a></li>
                <li class="breadcrumb-item"><a href="#">Book</a></li>
                <li class="breadcrumb-item active text-dark " aria-current="page">Details</li>
            </ol>
        </nav>
    </div>
</div>
<!-- Page Header End -->
<div class="container my-5">
    <!-- Book Details -->
    <div class="section-title text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
        <h1 class="display-6">Details</h1>
    </div>
    <div class="row mt-5 px-5">
        <div class="col-lg-3 text-center">
            <img src="./assets/img/<?= $row['image'] ?>" alt="A Haunted House Cover" class="img-fluid">

        </div>
        <div class="col-lg-7 mx-auto">
            <h2 class="fs-2 fw-medium my-2 p-0"><?= $row['title'] ?></h2>

            <p>by <a href="#"><?php echo $row['first_name'] . ' ' . $row['last_name'] ?></a></p>
            <p><?= $row['ISBN_code'] ?></p>

            <p class="text-muted">$<?= $row['price'] ?></p>
            <p><?= $row['short_description'] ?></p>

            <div class="d-flex justify-content-center justify-content-xl-between flex-column flex-md-row text-center ms-lg-5 ms-xl-0 my-lg-4">
                <div class="border pt-3 px-4 m-3 m-xl-0 ">
                    <p><strong>Genre</strong></p>
                    <span class="text-muted"><?= $row['genre_name'] ?></span>
                </div>
                <div class="border pt-3 px-4 m-3 m-xl-0 ">
                    <p><strong>Publish Date</strong></p>
                    <span class="text-muted">1985</span>
                </div>
                <div class="border pt-3 px-4 m-3 m-xl-0 ">
                    <p><strong>Publisher</strong></p>
                    <a href="#" class="fs-6"><?= $row['publisher_name'] ?></a>
                </div>
                <div class="border pt-3 px-4 m-3 m-xl-0 ">
                    <p><strong>Language</strong></p>
                    <p class="fs-6">English</p>
                </div>
            </div>
            <div class="mx-auto mx-lg-start">
                <form method='POST' class='addCard' action='actions/add_to_cart.php'>
                    <input type='text' hidden name='id' value='<?= $row['id'] ?>'>
                    <button name="submit" class="btn btn-dark rounded-pill py-2 px-4 m-2" type='submit'>Add To Cart <i class='fa fa-cart-plus ms-2'></i></button>
                </form>
            </div>
        </div>
        <!-- Book Details End -->
        <!-- More Books -->
        <div class="row wow fadeIn" data-wow-delay="0.1s">
            <div class="col-lg-12 text-center pt-3">
                <div class="section-title text-center mx-auto wow fadeInUp" data-wow-delay="0.1s">
                    <h1 class="display-6">More Books</h1>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-10 mx-auto">
                <div class="swiper mySwiper wow fadeIn" data-wow-delay="0.2s">
                    <div class="swiper-wrapper">
                        <?= $bookItem ?>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </div>
        <!-- More Books End -->
    </div>
</div>
<?php include('components/footer.php'); ?>