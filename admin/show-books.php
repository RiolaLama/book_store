<?php

include('middlewares/admin-middleware.php');
$currentPage = 'show-books';
$title = "Display Books";


$books = getAll('book');
$tbody = '';
if (mysqli_num_rows($books)  > 0) {
    foreach($books as $row){
        $tbody .= "
        <div class='col-12 col-md-6 col-lg-4 col-xl-3 mb-4 mb-lg-4'>
            <div class='card'>
                <img src='../assets/img/{$row['image']}' class='card-img-top' id='book-img' alt='book' />
                <div class='card-body'>
                    <div class='d-flex justify-content-between'>
                        <p class='small'><a href='#!' class='text-muted pe-auto'></a></p>
                        <p class='small'>$"  . $row['price'] . "</p>
                    </div>
                    <div class='mb-3 h-25'>
                        <h5 class='mb-0'>{$row['title']}</h5>
                    </div>
                    <form action='books/actions.php' method='POST'>
                        <div class='d-flex flex-column justify-content-between align-items-center pb-2 mb-1'>
                            <a href='books/update-book.php?id=" . $row['id'] . "' class='btn btn-warning w-100 my-2 fw-bold'>Edit</a>
                            <input type='hidden' name='id' value={$row['id']}>
                            <button type='submit' class='btn btn-danger w-100 fw-bold' name='delete-book'>Delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>";
    }
} else {
    $tbody =  "<div class='text-center h3'>No Data Available! </div>";
}

mysqli_close($connect);
?>
<?php include('components/header.php'); ?>

<div class="container">
    <div class="d-flex justify-content-center">
        <a href="books/add-book.php" class="btn btn-primary btn-block my-3">Add New Book</a>
    </div>
    <div class="row mx-5 mx-md-0 my-5">
        <?= $tbody ?>
    </div>
</div>
<?php include('components/footer.php') ?>