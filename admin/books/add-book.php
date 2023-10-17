<?php

include('../middlewares/admin-middleware.php');
$currentPage = 'show-books';
$title = 'Add New Book';

$result1 = getAll('genres');
$options = "";
while ($row = mysqli_fetch_assoc($result1)) {
        $options .= "<option value='{$row["id"]}'>{$row["name"]}</option>";
}
?>
<?php include('../components/header.php'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-11 mx-auto my-5">
            <div class="card">
                <div class="card-header ">
                    <h4>Add New Book</h4>
                </div>
                <form action="actions.php" method="post" enctype="multipart/form-data">
                    <div class="card-body">

                        <div class="row ">
                            <div class="col-6 col-md-4 col-lg-3 mx-auto">
                                <img class='img-thumbnail mx-auto d-block' src='../../assets/img/book.jpg' alt="default-pic" name='picture-placeholder' id='picture-placeholder' />
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-6 col-md-4 col-lg-3 mx-auto">
                                <label for="picture-upload" class="btn btn-primary mx-auto d-block">
                                    <i class="fa fa-fw fa-camera"></i>
                                    <span>Add Picture</span>
                                </label>
                                <input id="picture-upload" class="form-control" style="display: none;" type="file" name="picture" />

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label" for="title">Title</label>
                                <input type="text" id="title" class="form-control" name="title" required />
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="isbn">ISBN Code</label>
                                <input type="text" id="isbn" class="form-control" name="isbn_code" required />
                            </div>
                        </div>
                        <div class="row my-3">
                            <div class="col-md-4 col-lg-3">
                                <label class="form-label" for="genre">Genre</label>
                                <select id="genre" class="form-select" name="genre">
                                    <option selected value="null">Select Genre</option>
                                    <?= $options ?>;
                                </select>
                            </div>
                            <div class="col-md-3 col-lg-2">
                                <label class="form-label" for="price">Price</label>
                                <input id="price" class="form-control" type="text" name="price" required />
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label" for="author_name">Author's first name</label>
                                <input id="author_name" class="form-control" type="text" name="author_first_name" required />
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="author_lname">Author's last name</label>
                                <input id="author_lname" class="form-control" type="text" name="author_last_name" required />
                            </div>
                        </div>
                        <div class="row my-3">
                            <div class="col">
                                <label class="form-label" for="description">Description </label>
                                <textarea rows="4" id="description" class="form-control" name="short_description" required></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label class="form-label" for="publisher_name">Publisher's name</label>
                                <input id="publisher_name" class="form-control" type="text" name="publisher_name" required />
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="publisher_address">Publisher's address</label>
                                <input id="publisher_address" class="form-control" type="text" name="publisher_address" required />
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="publisher_date">Publisher's date</label>
                                <input id="publisher_date" class="form-control" type="date" name="publisher_date" required />
                            </div>
                        </div>
                        <div class="row my-5">
                            <div class="col-md-4 col-lg-3 col-xl-2 mb-3">
                                <button type="submit" class="btn btn-success w-100" name="add-book">Insert Book</button>
                            </div>
                            <div class="col-md-4 col-lg-3 col-xl-2 mb-3">
                                <a href="../show-books.php" class="btn btn-warning w-100" type="button">Back</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include('../components/footer.php') ?>
