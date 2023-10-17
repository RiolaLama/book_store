<?php
include('../middlewares/admin-middleware.php');

if (isset($_POST['add-book'])) {
    $title = $_POST['title'];
    $price = $_POST['price'];
    $genre = isset($_POST["genre"]) ? $_POST["genre"] : null;
    $isbn_code = $_POST['isbn_code'];
    $short_description = $_POST['short_description'];
    $author_first_name = $_POST['author_first_name'];
    $author_last_name = $_POST['author_last_name'];
    $publisher_name = $_POST['publisher_name'];
    $publisher_address = $_POST['publisher_address'];
    $publisher_date = $_POST['publisher_date'];
    $picture = file_upload($_FILES['picture'], "book");

    $sql = "INSERT INTO `book`(`title`, `image`, `ISBN_code`, `short_description`, `price`,  `author_first_name`, `author_last_name`, `publisher_name`, `publisher_address`, `publish_date`,`genre_id`) VALUES ('$title','$picture->fileName','$isbn_code', '$short_description','$price',' $author_first_name',' $author_last_name','$publisher_name','$publisher_address',' $publisher_date', $genre)";

    if (mysqli_query($connect, $sql) === true) {
        redirect("add-book.php", "Book added successfully!");
    } else {
        redirect("add-book.php", "Something went wrong!",'danger');

    }
} elseif (isset($_POST['update-book'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $price = $_POST['price'];
    $genre = isset($_POST["genre"]) ? $_POST["genre"] : null;
    $picture = $_POST['picture'];
    $isbn_code = $_POST['isbn_code'];
    $short_description = mysqli_real_escape_string($connect, $_POST['short_description']);

    // $short_description = $_POST['short_description'];
    $author_first_name = $_POST['author_first_name'];
    $author_last_name = $_POST['author_last_name'];
    $publisher_name = $_POST['publisher_name'];
    $publisher_address = $_POST['publisher_address'];
    $publisher_date = $_POST['publisher_date'];
    $picture = file_upload($_FILES['picture'], "book"); 

    if ($picture->error === 0) {
        ($_POST["picture"] == "book.jpg") ?: unlink("../../assets/img/$_POST[picture]");
        $sql = "UPDATE `book` SET `title`='$title',`image`='$picture->fileName',`ISBN_code`='$isbn_code',`short_description`='$short_description',`price`='$price',`author_first_name`='$author_first_name',`author_last_name`='$author_last_name',`publisher_name`=' $publisher_name',`publisher_address`='$publisher_address',`publish_date`='$publisher_date', `genre_id`= '$genre' WHERE id = {$id}";
    } else {
        $sql = "UPDATE `book` SET `title`='$title',`ISBN_code`='$isbn_code',`short_description`='$short_description',`price`='$price',`author_first_name`='$author_first_name',`author_last_name`='$author_last_name',`publisher_name`='$publisher_name',`publisher_address`='$publisher_address',`publish_date`='$publisher_date',`genre_id`='$genre' WHERE id = {$id}";
    }
    if (mysqli_query($connect, $sql) === TRUE) {
        var_dump($genre);
        redirect("update-book.php?id=".$id, "Book updated successfully!");
    } else {
        redirect("update-book.php?id=".$id, "Something went wrong!");
    }
}else if (isset($_POST['delete-book'])) {
    $id = $_POST['id'];
    $book = getById('book', $id);
    $row = mysqli_fetch_assoc($book); 
    $picture = $row['image'];
    if($picture  != "book.jpg"){
        unlink("../../assets/img/$picture");
    }
    $sql = "DELETE FROM book WHERE id = {$id}";
    if (mysqli_query($connect, $sql) === TRUE) {
        redirect("../show-books.php", "Book deleted successfully!");
    } else {
        redirect("../show-books.php", "Something went wrong!");
    }

}
