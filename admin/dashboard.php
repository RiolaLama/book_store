<?php
include('middlewares/admin-middleware.php');
$currentPage = 'dashboard';
$title = "Dashboard";

function countRec($result, &$var1)
{
    if ($result) {
        $row = $result->fetch_assoc();
        $var1 = $row['count'];
    } else {
        $var1 = 0;
    }
}
$result1 = countRecords('users');
$userCount = 0;
countRec($result1, $userCount);

$result2 = countRecords('book');
$bookCount = 0;
countRec($result2, $bookCount);

$result3 = countRecords('genres');
$genreCount = 0;
countRec($result3, $genreCount);

mysqli_close($connect);
?>
<?php include('components/header.php'); ?>
<div class="container-fluid px-4">
    <div class="row g-4 my-5">
        <div class="col-md-6 col-lg-4">
            <div class="p-4 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                <div>
                    <h3 class="fs-2"><?= $userCount ?></h3>
                    <a href="show-users.php" class="fs-5 text-decoration-none text-dark fw-bold">Users</a>
                </div>
                <a href="show-users.php"><i class="fa-solid fa-user fs-1 primary-text border rounded-full secondary-bg p-3"></i></a>

            </div>
        </div>

        <div class="col-md-6 col-lg-4">
            <div class="p-4 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                <div>
                    <h3 class="fs-2"><?= $bookCount ?></h3>
                    <a href="show-books.php" class="fs-5 text-decoration-none text-dark fw-bold">Books</a>
                </div>
                <a href="show-books.php">
                    <i class="fa-solid fa-book fs-1 primary-text border rounded-full secondary-bg p-3"></i></a>
            </div>
        </div>

        <div class="col-md-6 col-lg-4">
            <div class="p-4 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                <div>
                    <h3 class="fs-2"><?= $genreCount ?></h3>
                    <a href="show-genres.php" class="fs-5 text-decoration-none text-dark fw-bold">Genres</a>
                </div>
                <a href="show-genres.php"><i class="fa-solid fa-diagram-project fs-1 primary-text border rounded-full secondary-bg p-3"></i></a>
            </div>
        </div>
    </div>

</div>
<?php include('components/footer.php') ?>