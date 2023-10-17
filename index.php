<?php
include 'controllers/user-controller.php';
$currentPage = 'home';
$title = "Home Page";
$sql = "SELECT * FROM book LIMIT 5";
$result= mysqli_query($connect, $sql);
$tbody = '';
if (mysqli_num_rows($result)  > 0) {
    foreach ($result as $row) {
        $tbody .= "
        <div class='col-lg-4 col-md-6 wow fadeInUp' data-wow-delay='0.1s'>
            <div class='store-item position-relative text-center'>
                <img class='img-fluid' src='assets/img/{$row['image']}' alt='{$row['title']}'>
                <div class='p-4'>
                    <h4 class='mb-3'>{$row['title']}</h4>
                    <p>{$row['short_description']}</p>
                    <h4 class='text-primary'>Author: {$row['author_first_name']} {$row['author_last_name']} </h4>
                </div>
                <div class='store-overlay'>
                    <a href='details.php?id={$row['id']}' class='btn btn-primary rounded-pill py-2 px-4 m-2'>More Detail <i class='fa fa-arrow-right ms-2'></i></a>
                    <a href='cart.php?id={$row['id']}' class='btn btn-dark rounded-pill py-2 px-4 m-2'>Add to Cart <i class='fa fa-cart-plus ms-2'></i></a>
                </div>
            </div>
        </div>";
    };
} else {
    $tbody =  "<div><p>No Data Available </p></div>";
}

mysqli_close($connect);
?>

<?php include "components/header.php" ?>

<!-- Carousel Start -->
<?php include 'components/hero.php' ?>
<!-- Carousel End -->

<!-- About Start -->
<?php include 'components/about-page.php' ?>
<!-- About End -->

<!-- Store Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="section-title text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
            <p class="fs-5 fw-medium fst-italic text-primary">Online Store</p>
            <h1 class="display-6">Our Books</h1>
        </div>
        <div class="row g-4">
            <?= $tbody; ?>
            <div class="col-12 text-center wow fadeInUp" data-wow-delay="0.1s">
                <a href="books.php" class="btn btn-primary rounded-pill py-3 px-5">View More Books</a>
            </div>
        </div>
    </div>
</div>
<!-- Store End -->

<!-- Testimonial Start -->
<!-- <div class="container-fluid testimonial py-5 my-5">
    <div class="container py-5">
        <div class="section-title text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
            <p class="fs-5 fw-medium fst-italic text-white">Testimonial</p>
            <h1 class="display-6">What our clients say about our books</h1>
        </div>
        <div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.5s">
            <div class="testimonial-item p-4 p-lg-5">
                <p class="mb-4">Diam dolor diam ipsum sit. Aliqu diam amet diam et eos. Clita erat ipsum et lorem et sit, sed stet lorem sit clita duo justo</p>
                <div class="d-flex align-items-center justify-content-center">
                    <img class="img-fluid flex-shrink-0" src="assets/pictures/testimonial-1.jpg" alt="">
                    <div class="text-start ms-3">
                        <h5>Client Name</h5>
                        <span class="text-primary">Profession</span>
                    </div>
                </div>
            </div>
            <div class="testimonial-item p-4 p-lg-5">
                <p class="mb-4">Diam dolor diam ipsum sit. Aliqu diam amet diam et eos. Clita erat ipsum et lorem et sit, sed stet lorem sit clita duo justo</p>
                <div class="d-flex align-items-center justify-content-center">
                    <img class="img-fluid flex-shrink-0" src="assets/pictures/testimonial-2.jpg" alt="">
                    <div class="text-start ms-3">
                        <h5>Client Name</h5>
                        <span class="text-primary">Profession</span>
                    </div>
                </div>
            </div>
            <div class="testimonial-item p-4 p-lg-5">
                <p class="mb-4">Diam dolor diam ipsum sit. Aliqu diam amet diam et eos. Clita erat ipsum et lorem et sit, sed stet lorem sit clita duo justo</p>
                <div class="d-flex align-items-center justify-content-center">
                    <img class="img-fluid flex-shrink-0" src="assets/pictures/testimonial-3.jpg" alt="">
                    <div class="text-start ms-3">
                        <h5>Client Name</h5>
                        <span class="text-primary">Profession</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> -->
<!-- Testimonial End -->


<!-- Contact Start -->
<div class="container-xxl contact py-5">
    <div class="container">
        <div class="section-title text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
            <p class="fs-5 fw-medium fst-italic text-primary">Contact Us</p>
            <h1 class="display-6">Contact us right now</h1>
        </div>
        <div class="row justify-content-center wow fadeInUp" data-wow-delay="0.1s">
            <div class="col-lg-8">
                <p class="text-center mb-5">Diam dolor diam ipsum sit. Aliqu diam amet diam et eos. Clita erat ipsum et lorem et sit, sed stet lorem sit clita duo justo Diam dolor diam ipsum sit. Aliqu diam amet diam et eos. Clita erat ipsum et lorem et sit, sed stet lorem sit clita duo justo</p>
                <div class="row g-5">
                    <div class="col-md-4 text-center wow fadeInUp" data-wow-delay="0.3s">
                        <div class="btn-square mx-auto mb-3">
                            <i class="fa fa-envelope fa-2x text-white"></i>
                        </div>
                        <p class="mb-2">info@example.com</p>
                        <p class="mb-0">support@example.com</p>
                    </div>
                    <div class="col-md-4 text-center wow fadeInUp" data-wow-delay="0.4s">
                        <div class="btn-square mx-auto mb-3">
                            <i class="fa fa-phone fa-2x text-white"></i>
                        </div>
                        <p class="mb-2">+012 345 67890</p>
                        <p class="mb-0">+012 345 67890</p>
                    </div>
                    <div class="col-md-4 text-center wow fadeInUp" data-wow-delay="0.5s">
                        <div class="btn-square mx-auto mb-3">
                            <i class="fa fa-map-marker-alt fa-2x text-white"></i>
                        </div>
                        <p class="mb-2">123 Street</p>
                        <p class="mb-0">New York, USA</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Contact Start -->

<?php include "components/footer.php" ?>