<?php
include 'controllers/user-controller.php';
$currentPage = 'about';
$title = "About us";

$sql = "SELECT * FROM users WHERE id = {$_SESSION[$userType]}";
$result = mysqli_query($connect, $sql);
$user = mysqli_fetch_assoc($result);

?>
<?php include('components/header.php') ?>
<!-- Page Header Start -->
<div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container text-center py-5">
        <h1 class="display-2 text-dark mb-4 animated slideInDown">About Us</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item "><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Pages</a></li>
                <li class="breadcrumb-item active text-dark " aria-current="page">About</li>
            </ol>
        </nav>
    </div>
</div>
<!-- Page Header End -->

<?php include('components/about-page.php') ?>
<?php include('components/footer.php') ?>