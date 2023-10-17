<?php

include('../middlewares/admin-middleware.php');
$currentPage = 'update-book';
$title = 'Edit Book';


if ($_GET['id']) {
    $id = $_GET['id'];
    $result = getById('book', $id);


    if (mysqli_num_rows($result) == 1) {
        $data = mysqli_fetch_assoc($result);
        $title = $data['title'];
        $price = $data['price'];
        $picture = $data['image'];
        $isbn_code = $data['ISBN_code'];
        $short_description = $data['short_description'];
        $author_first_name = $data['author_first_name'];
        $author_last_name = $data['author_last_name'];
        $publisher_name = $data['publisher_name'];
        $publisher_address = $data['publisher_address'];
        $publisher_date = $data['publish_date'];
    } else {
        redirect("../show-books.php", "Something went wrong!");
    }

    $result1 = getAll('genres');
    $options = "";
    while ($row = mysqli_fetch_assoc($result1)) {
        if ($data['genre_id'] == $row['id']) {
            $options .= "<option selected value='{$row["id"]}'>{$row["name"]}</option>";
        } else {
            $options .= "<option value='{$row["id"]}'>{$row["name"]}</option>";
        }
    }
}
?>
<?php include('../components/header.php'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-11 mx-auto my-5">
            <div class="card">
                <div class="card-header ">
                    <h4>Update Book</h4>
                </div>
                <form action="actions.php" method="post" enctype="multipart/form-data">
                    <div class="card-body">

                        <div class="row ">
                            <div class="col-6 col-md-4 col-lg-3 mx-auto">
                                <img class='img-thumbnail mx-auto d-block' src='../../assets/img/<?= $picture ?>' alt="<?= $title ?>" name='picture-placeholder' id='picture-placeholder' />
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-6 col-md-4 col-lg-3 mx-auto">
                                <label for="picture-upload" class="btn btn-primary mx-auto d-block">
                                    <i class="fa fa-fw fa-camera"></i>
                                    <span>Change Photo</span>
                                </label>
                                <input id="picture-upload" style="display: none;" type="file" name="picture" />

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label" for="title">Title</label>
                                <input type="text" id="title" class="form-control" name="title" value="<?= $title ?>" />
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="isbn">ISBN Code</label>
                                <input type="text" id="isbn" class="form-control" name="isbn_code" value="<?= $isbn_code ?>" />
                            </div>
                        </div>
                        <div class="row my-3">
                            <div class="col-md-4 col-lg-3">
                                <label class="form-label" for="genre">Genre</label>
                                <select id="genre" class="form-control" name="genre">
                                    <?= $options ?>;
                                </select>
                            </div>
                            <div class="col-md-3 col-lg-2">
                                <label class="form-label" for="price">Price</label>
                                <input id="price" class="form-control" type="text" name="price" value="<?= $price ?>" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label" for="author_name">Author's first name</label>
                                <input id="author_name" class="form-control" type="text" name="author_first_name" value="<?= $author_first_name ?>" />
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="author_lname">Author's last name</label>
                                <input id="author_lname" class="form-control" type="text" name="author_last_name" value="<?= $author_last_name ?>" />
                            </div>
                        </div>
                        <div class="row my-3">
                            <div class="col">
                                <label class="form-label" for="description">Description </label>
                                <textarea rows="4" id="description" class="form-control" name="short_description"><?= $short_description ?></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label class="form-label" for="publisher_name">Publisher's name</label>
                                <input id="publisher_name" class="form-control" type="text" name="publisher_name" value="<?= $publisher_name ?>" />
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="publisher_address">Publisher's address</label>
                                <input id="publisher_address" class="form-control" type="text" name="publisher_address" value="<?= $publisher_address ?>" />
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="publisher_date">Publisher's date</label>
                                <input id="publisher_date" class="form-control" type="date" name="publisher_date" value="<?= $publisher_date ?>" />
                            </div>
                        </div>
                        <div class="row my-5">
                            <div class="col-md-4 col-lg-3 col-xl-2 mb-3">
                                <input type="hidden" name="id" value="<?= $data['id'] ?>" />
                                <input type="hidden" name="picture" value="<?= $data['image'] ?>" />
                                <button type="submit" class="btn btn-success w-100" name="update-book">Save Changes</button>

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