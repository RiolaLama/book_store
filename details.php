<?php
include 'controllers/user-controller.php';
$currentPage = 'book-details';
$title = "Book Details";
$id = $_GET['id'];
$result1 = getById('book', $id);
$row = mysqli_fetch_assoc($result1);

$bookItem = '';
$result = getMoreBooks('book', $id);
if (mysqli_num_rows($result)  > 0) {
    foreach ($result as $book) {
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
<!-- Book Details -->
<div class="container">
    <div class="col-md-10 col-lg-12  p-3 bg-light mx-auto">
        <div class="section-title text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
            <!-- <p class="fs-5 fw-medium fst-italic text-primary">Explore This Book</p> -->
            <h1 class="display-6">Details</h1>
        </div>


        <div class="row m-0">
            <div class="col-lg-5 left-side-product-box pb-3">
                <img src="./assets/img/<?= $row['image'] ?>">
            </div>
            <div class="col-lg-7">
                <div class="right-side-pro-detail p-3 m-0">
                    <div class="row">
                        <div class="col-lg-12">
                            <h2 class="fs-3 fw-medium fst-italic text-primary my-2 p-0"><?= $row['title'] ?></h2>
                        </div>
                        <div class="col-lg-12 my-2">
                            <p class="p-0 price-pro fs-6">$<?= $row['price'] ?></p>
                            <hr class="p-0 my-2">
                        </div>
                        <div class="col-lg-12 pt-2 my-2">
                            <span class='fs-6 fw-small'><?= $row['short_description'] ?></span>
                            <hr class="pt-2 mt-2">
                        </div>
                        <div class="col-lg-12">
                            <p class="fs-6 fw-small text-dark">Author : <strong class="fw-medium fst-italic text-primary"><?php echo $row['author_first_name'] . ' ' . $row['author_last_name'] ?></strong></p>
                        </div>
                        <div class="col-lg-12">
                            <p class="fs-6 fw-small text-dark">Publisher : <span class="fs-6 fw-small"><?php echo $row['publisher_name'] ?></span></p>
                        </div>
                        <!-- <div class="col-lg-4">
                            <p class="fs-5 fw-medium text-dark">Quantity :</p>
                            <input type="number" class="form-control text-center w-100" value="1">
                        </div> -->

                        <form method='POST' class='addCard' action='actions/add_to_cart.php'>
                            <div class="col-lg-5 mt-3">
                                <input type='text' hidden name='id' value='<?= $row['id'] ?>'>
                                <button name="submit" class="btn btn-dark rounded-pill py-2 px-4 m-2 w-100 " type='submit'>Add To Cart <i class='fa fa-cart-plus ms-2'></i></button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
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
        <div class="col-md-10">
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


<?php include('components/footer.php'); ?>