<?php

include('../middlewares/admin-middleware.php');
$currentPage = 'add-genre';
$title = 'Add New Genre';
?>
<?php include('../components/header.php'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-11 mx-auto my-5">
            <div class="card">
                <div class="card-header ">
                    <h4>Add New Genre</h4>
                </div>
                <form action="actions.php" method="post" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label" for="title">Name</label>
                                <input type="text" id="name" class="form-control" name="name" required/>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="picture">Upload image</label>
                                <input type="file" id="picture" class="form-control" name="picture" />
                            </div>

                        </div>
                        <div class="row my-3">
                            <div class="col">
                                <label class="form-label" for="description">Description </label>
                                <textarea rows="4" id="description" class="form-control" name="description" required></textarea>
                            </div>
                        </div>
                        <div class="row my-3">
                            <div class="col-md-4">
                                <label class="form-label" for="status">Status</label>
                                <select id="status" class="form-control" name="status">
                                    <option value='1'>Visible</option>
                                    <option value='0'>Hidden</option>
                                </select>
                            </div>
                            <div class="col">
                                <label class="form-label" for="popular">Popular </label>
                                <input type="checkbox" id="popular" name="popular" />
                            </div>
                        </div>
                        <div class="row my-5">
                            <div class="col-md-4 col-lg-3 col-xl-2 mb-3">
                                <button type="submit" class="btn btn-success w-100" name="add-genre">Add Genre</button>
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

</html>