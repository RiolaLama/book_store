<?php

include('middlewares/admin-middleware.php');
$currentPage = 'genres';
$title = "Display Genres";


$genres = getAll('genres');
$tbody = '';
if (mysqli_num_rows($genres)  > 0) {
    foreach ($genres as $genre) {
        $tbody .= "
        <tr class= 'text-center'>
            <td>{$genre['id']}</td>
            <td>{$genre['name']}</td>
   
            <td>" . ($genre['status'] == '1' ? 'Visible' : 'Hidden') . "</td>
            <td>
            <form action='genres/actions.php' method='POST'>
                <a href='genres/update-genre.php?id={$genre['id']}' class='btn btn-warning  my-2 fw-bold'>Edit</a>
                <input type='hidden' name='id' value={$genre['id']}>
                <button type='submit' class='btn btn-danger' name='delete-genre'>Delete</button>
            </form>
            </td>
        </tr>";
    }
} else {
    $tbody =  "<tr><div class='text-center h3'>No Data Available! </div></tr>";
}

mysqli_close($connect);
?>
<?php include('components/header.php'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>
                        Genres
                    </h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr class='text-center'>
                                <th>Id</th>
                                <th>Genre</th>
                                <th>Status</th>
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

<?php include('components/footer.php'); ?>