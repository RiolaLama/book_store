<?php

include('../middlewares/admin-middleware.php');
$currentPage = 'add-user';
$title = 'Add New User';

$formSubmitted = false;

// $result1 = getAll('users');
// $options = "";
// while ($row = mysqli_fetch_assoc($result1)) {
//         $options .= "<option value='{$row["id"]}'>{$row["name"]}</option>";
// }

?>
<?php include('../components/header.php'); ?>
<div class="container-fluid">

  <div class="container">
    <form action="actions.php" method="post" enctype="multipart/form-data">
      <h2 class="h5 mb-3 mb-lg-0 ms-2">Create new customer</h2>
      <!-- Main content -->
      <div class="row mt-3">
        <!-- Left side -->
        <div class="col-md-9 col-lg-4 col-xl-3 mx-auto">
          <div class="card h-100 mb-4">
            <div class="img-container mx-auto mt-3 px-3">
              <img src="../../assets/img/user.jpg" class='img-thumbnail img-fluid' alt="default-pic" name='picture-placeholder' id='picture-placeholder'>
            </div>
            <div class="card-body mt-3">
              <label for="picture-upload" class="btn btn-primary mx-auto d-block">
                <i class="fa fa-fw fa-camera"></i>
                <span>Add Picture</span>
              </label>
              <input id="picture-upload" class="form-control" style="display: none;" type="file" name="picture" />
              <div class="status mt-5">
                <h3 class="h6">Status</h3>
                <select id="status" class="form-select" name="status">
                  <option value="user" >User</option>
                  <option value="admin">Admin</option>
                </select>
              </div>
            </div>
          </div>

        </div>
        <!-- Right side -->
        <div class="col-xl-9 col-lg-8 col-md-11 mx-auto mt-3 mt-lg-0">
          <div class="card mb-4 h-100">
            <div class="card-body">
              <h3 class="h6 mb-4">Basic information</h3>
              <div class="row">
                <div class="col-lg-6">
                  <div class="mb-3">
                    <label class="form-label">First name</label>
                    <input type="text" class="form-control" name="first_name" >
                  
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="mb-3">
                    <label class="form-label">Last name</label>
                    <input type="text" class="form-control" name="last_name">
                
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-6">
                  <div class="mb-3">
                    <label class="form-label">Gender</label>
                    <select class="form-control" name="gender">
                      <option value="null">Select Gender</option>
                      <option value="female">Female</option>
                      <option value="male">Male</option>
                    </select>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="mb-3">
                    <label class="form-label">Date of Birth</label>
                    <input type="date" class="form-control" name="birth_date">
                  
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-6">
                  <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" name="email">
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-control" name="password">
                  </div>
                </div>
              </div>
              <h3 class="h6 mb-4">Address</h3>
              <div class="row">
                <div class="col-lg-6">
                  <div class="mb-3">
                    <label class="form-label">Street</label>
                    <input type="text" class="form-control" name="street">
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="mb-3">
                    <label class="form-label">City</label>
                    <input type="text" class="form-control" name="city">
                  </div>
                </div>

              </div>
              <div class="row">
                <div class="col-lg-6">
                  <div class="mb-3">
                    <label class="form-label">State</label>
                    <input type="text" class="form-control" name="state">
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="mb-3">
                    <label class="form-label">ZIP code</label>
                    <input type="text" class="form-control" name="zip_code">
                  </div>
                </div>
              </div>
              <!-- Buttons -->
              <div class="row gutters mt-4">
                <div class="col-12">
                  <div class="text-right">
                  <input type="hidden" id="form-submitted" value="<?php echo $formSubmitted ? '1' : '0'; ?>">
                    <button type="submit" class="btn btn-success " name="add-user">Add User</button>
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

</div>

<?php include('../components/footer.php') ?>