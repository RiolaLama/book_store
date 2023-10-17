<?php
include('../middlewares/admin-middleware.php');
$currentPage = 'edit-user';
$title = "Edit user";


$sql = "SELECT * FROM users JOIN address_code  ON users.address_code_id = address_code.id WHERE users.id = {$_SESSION[$userType]}";
$result = mysqli_query($connect, $sql);
$user = mysqli_fetch_assoc($result);

// $id = $_SESSION['admin'];
// $status = 'admin';
// $sql = "SELECT * FROM users WHERE user_type != '$status'";
// $result = mysqli_query($connect, $sql);

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // $result = getById('users', $id);
    $sql = "SELECT *
    FROM users 
    JOIN address_code  ON users.address_code_id = address_code.id
    WHERE users.id = {$id}";
    $result = mysqli_query($connect, $sql);
    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);
        // $password = $user['password'];
    }
}
?>
<?php include('../components/header.php'); ?>
<div class="container">
    <form action="actions.php" method="post" id='form' enctype="multipart/form-data">
        <div class="row gutters mx-3 my-5">
            <div class="col-xl-3 col-lg-4 col-md-11 col-12 mx-auto my-3 my-lg-0 ">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="account-settings">
                            <div class="user-profile">
                                <div class="img-container mx-auto my-3 px-3">
                                    <img src='../../assets/img/<?= $user['profile_picture'] ?>' class='img-thumbnail img-fluid' alt="<?= $user['first_name'] ?>" name='picture-placeholder' id='picture-placeholder'>
                                </div>
                                <h5 class="user-name"><?= $user['first_name'] . ' ' . $user['last_name'] ?></h5>
                                <h6 class="user-email"><?= $user['email'] ?></h6>
                            </div>
                            <div class="photo-btn">
                                <label for="picture-upload" class="btn btn-primary mx-auto ">
                                    <i class="fa fa-fw fa-camera"></i>
                                    <span>Change Photo</span>
                                </label>
                                <input id="picture-upload" style="display: none;" type="file" name="picture" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-9 col-lg-8 col-md-11 col-12 mx-auto">
                <div class="card h-100">
                    <div class="card-header ">
                        <h6 class="text-primary mt-2">Personal Details</h6>
                    </div>
                    <div class="card-body">
                        <div class="row gutters">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="first_name">First Name</label>
                                    <input type="text" class="form-control" id="first_name" name="first_name" value="<?= $user['first_name'] ?>">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="last_name">Last Name</label>
                                    <input type="text" class="form-control" id="last_name" name="last_name" value="<?= $user['last_name'] ?>">
                                </div>
                            </div>
                            <div class="col-sm-6 mt-3">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" class="form-control" id="email" name="email" value="<?= $user['email'] ?>">
                                </div>
                            </div>
                            <div class="col-sm-6 mt-3">
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" name="password">
                                </div>
                            </div>
                            <div class="col-sm-6 mt-3">
                                <div class="form-group">
                                    <label>Date of Birth</label>
                                    <input type="date" class="form-control" name="birth_date" value="<?= $user['birth_date'] ?>">
                                </div>
                            </div>
                            <div class="col-sm-6 mt-3">
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select id="status" class="form-control" name="status">
                                        <option value="user" <?= ($user['user_type'] === 'user') ? 'selected' : '' ?>>User</option>
                                        <option value="admin" <?= ($user['user_type'] === 'admin') ? 'selected' : '' ?>>Admin</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row gutters">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                <h6 class="text-primary mt-3">Address</h6>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="street">Street</label>
                                    <input type="text" class="form-control" id="street" name="street" value="<?= $user['street_address'] ?>">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="city">City</label>
                                    <input type="text" class="form-control" id="city" name="city" value="<?= $user['city'] ?>">
                                </div>
                            </div>
                            <div class="col-sm-6 mt-3">
                                <div class="form-group">
                                    <label for="state">State</label>
                                    <input type="text" class="form-control" id="state" name="state" value="<?= $user['state'] ?>">
                                </div>
                            </div>
                            <div class="col-sm-6 mt-3">
                                <div class="form-group">
                                    <label for="zip">Zip Code</label>
                                    <input type="text" class="form-control" id="zip" name="zip_code" value="<?= $user['zip_code'] ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row gutters mt-4">
                            <div class="col-12">
                                <input type="hidden" name="id" value="<?= $id ?? $_SESSION[$userType] ?>" />
                                <input type="hidden" name="picture" value="<?= $user['profile_picture'] ?>" />
                                <div class="text-right">
                                    <button type="submit" class="btn btn-success " name="edit-profile">Save Changes</button>
                                    <a href="../show-users.php" class="btn btn-warning " type="button">Back</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<?php include('../components/footer.php') ?>