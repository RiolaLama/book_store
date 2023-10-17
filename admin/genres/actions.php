<?php
include('../middlewares/admin-middleware.php');

if (isset($_POST['add-genre'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $status = isset($_POST["status"]) ? $_POST["status"] : null;
    $popular = isset($_POST['popular']) ? '1' : '0';
    $uploadError = '';
    $picture = file_upload($_FILES['picture'], "book");

    $sql = "INSERT INTO `genres`(`name`, `description`, `status`, `popular`, `image`) VALUES ('$name','$description','$status ', '$popular', '$picture->fileName')";

    if (mysqli_query($connect, $sql) === true) {
        redirect("add-genre.php", "Category added successfully!");
    } else {
        redirect("add-genre.php", "Something went wrong!");
    }
} else if (isset($_POST['update-genre'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $status = isset($_POST["status"]) ? $_POST["status"] : null;
    $popular = isset($_POST['popular']) ? '1' : '0';
    $uploadError = '';
    $picture = file_upload($_FILES['picture'], "book");
    if ($picture->error === 0) {
        ($_POST["picture"] == "book.jpg") ?: unlink("../../assets/img/$_POST[picture]");
        $sql = "UPDATE `genres` SET `name`='$name',`description`='$description',`status`='$status',`popular`='$popular',`image`='$picture->fileName' WHERE id = {$id}";
        // 
    } else {
        $sql = "UPDATE `genres` SET `name`='$name',`description`='$description',`status`='$status',`popular`='$popular' WHERE id = {$id}";
    }
    if (mysqli_query($connect, $sql) === TRUE) {
        redirect("update-genre.php?id=" . $id, "Genre updated successfully!");
    } else {
        redirect("update-genre.php?id=" . $id, "Something went wrong!");
    }
} else if (isset($_POST['delete-genre'])) {
    $id = $_POST['id'];
    $genre = getById('genres', $id);
    $row = mysqli_fetch_assoc($genre); 
    $picture = $row['image'];
    if($picture  != "book.jpg"){
        unlink("../../assets/img/$picture");
    }
    $sql = "DELETE FROM genres WHERE id = {$id}";
    if (mysqli_query($connect, $sql) === TRUE) {
        redirect("../show-genres.php", "Genre deleted successfully!");
    } else {
        redirect("../show-genres.php", "Something went wrong!");
    }

}
