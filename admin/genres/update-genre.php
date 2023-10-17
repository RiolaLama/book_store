<?php

include('../middlewares/admin-middleware.php');
$currentPage = 'update-genre';
$title = "Edit Genre";

if ($_GET['id']) {
    $id = $_GET['id'];
    $result = getById('genres', $id);

    if (mysqli_num_rows($result) == 1) {
        $data = mysqli_fetch_assoc($result);
        $name = $data['name'];
        $description = $data['description'];
        $picture = $data['image'];
        $status = $data['status'];
        $popular = $data['popular'];
    } else {
        redirect("../show-books.php", "Something went wrong!");
    }
    mysqli_close($connect);
}
?>
<?php include('../components/header.php'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-11 mx-auto my-5">
            <div class="card">
                <div class="card-header ">
                    <h4>Update Genre</h4>
                </div>
                <form action="actions.php" method="post" enctype="multipart/form-data">
                    <div class="card-body">

                        <div class="row ">
                            <div class="col-6 col-md-4 col-lg-3 mx-auto">
                                <img class='img-thumbnail mx-auto d-block' src='../../assets/img/<?= $picture ?>' alt="<?= $name ?>" name='picture-placeholder' id='picture-placeholder' />
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
                                <label class="form-label" for="name">Name</label>
                                <input type="text" id="name" class="form-control" name="name" value="<?= $name ?>" />
                            </div>
                        </div>
                        <div class="row my-3">
                            <div class="col">
                                <label class="form-label" for="description">Description </label>
                                <textarea rows="4" id="description" class="form-control" name="description"><?= $description ?></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label class="form-label" for="status">Status</label>
                                <select id="status" class="form-control" name="status">
                                    <option value='1' <?= ($status  == '1') ? 'selected' : ''; ?>>Visible</option>
                                    <option value='0' <?= ($status  == '0') ? 'selected' : ''; ?>>Hidden</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Popular </label>
                                <input type="checkbox" name="popular" <?= $popular ? "checked" : "" ?> />
                            </div>
                        </div>
                        <div class="row my-5">
                            <div class="col-md-4 col-lg-3 col-xl-2 mb-3">
                                <input type="hidden" name="id" value="<?= $data['id'] ?>" />
                                <input type="hidden" name="picture" value="<?= $picture ?>" />
                                <button type="submit" class="btn btn-success w-100" name="update-genre">Save Changes</button>

                            </div>
                            <div class="col-md-4 col-lg-3 col-xl-2 mb-3">
                                <a href="../show-genres.php" class="btn btn-warning w-100" type="button">Back</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include('../components/footer.php') ?>