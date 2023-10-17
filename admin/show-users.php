<?php
include('middlewares/admin-middleware.php');
$currentPage = 'show-users';
$title = "Display Users";


$id = $_SESSION['admin'];
$sql = " SELECT * FROM users WHERE id != {$id}";
$res = mysqli_query($connect, $sql);

$tbody = '';
if (mysqli_num_rows($res)  > 0) {
    foreach ($res as $user) {
        $tbody .= "
        <tr class= 'text-center'>
            <td>{$user['id']} </td>
            <td>
                <img src='../assets/img/{$user['profile_picture']}' alt='{$user['first_name']}'  style='width: 55px; height: 45px' class='img-thumbnail' />
                <p>{$user['first_name']}  {$user['last_name']} </p>
            </td>
            <td>{$user['email']}</td>
            <td>{$user['user_type']}</td>
            <td>
                <a href='users/edit-user.php?id={$user['id']}' class='btn btn-warning  my-2 fw-bold'>Edit</a>
                <input type='hidden' name='id' value={$user['id']}>
                <button type='submit' class='btn btn-danger delete-btn' value='{$user['id']}'>Delete</button>
            </td>
        </tr>";
    }
} else {
    $tbody = "<tr><td colspan='5'><center>No Data Available </center></td></tr>";
}

mysqli_close($connect);
?>
<?php include('components/header.php'); ?>
<div class="container-fluid px-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card" id='users-table'>
                <div class="card-header">
                    <h4>
                        User Managment
                    </h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr class='text-center'>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?= $tbody ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('components/footer.php') ?>