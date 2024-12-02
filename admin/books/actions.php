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
    $author_email = mysqli_real_escape_string($connect, $_POST['author_email']);
    // $publisher_name = $_POST['publisher_name'];
    // $publisher_address = $_POST['publisher_address'];
    // $publisher_date = $_POST['publisher_date'];
    $picture = file_upload($_FILES['picture'], "book");

    try {
        // Check if ISBN already exists
        $stmt = $connect->prepare("SELECT id FROM `book` WHERE ISBN_code = ? LIMIT 1");
        $stmt->bind_param("s", $isbn_code);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        if ($result->num_rows > 0) {
            // ISBN exists, so throw an exception or handle the error as you wish
            // throw new Exception('ISBN already exists.');
            redirect("add-book.php", "ISBN already exists!", 'danger');
        }
        // Insert book
        $stmt = $connect->prepare("INSERT INTO `book`(`title`, `image`, `ISBN_code`, `short_description`, `price`, `genre_id`) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssd", $title, $picture->fileName, $isbn_code, $short_description, $price, $genre);

        $stmt->execute();
        $book_id = $stmt->insert_id;
        $stmt->close();

        // Check if author already exists
        $stmt = $connect->prepare("SELECT id FROM `authors` WHERE first_name = ? AND last_name = ? AND email = ? LIMIT 1");
        $stmt->bind_param("sss", $author_first_name, $author_last_name, $author_email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 0) {
            // Author does not exist, so insert the new author
            $stmt->close(); // close previous statement
            $stmt = $connect->prepare("INSERT INTO `authors` (first_name, last_name, email) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $author_first_name, $author_last_name, $author_email);
            $stmt->execute();
            $author_id = $stmt->insert_id; // Get the new author's ID
            $stmt->close();
        } else {
            // Author exists, get the existing author's ID
            $existing_author = $result->fetch_assoc();
            $author_id = $existing_author['id'];
            $stmt->close();
        }

        // Insert into books_authors if we have both author_id and book_id
        if ($author_id !== null && $book_id !== null) {
            $stmt = $connect->prepare("INSERT INTO `books_authors` (book_id, author_id) VALUES (?, ?)");
            $stmt->bind_param("ii", $book_id, $author_id);
            $stmt->execute();
            $stmt->close();
        }

        // Commit transaction
        mysqli_commit($connect);
        redirect("add-book.php", "Book added successfully!");
    } catch (mysqli_sql_exception $exception) {
        mysqli_rollback($connect);
        redirect("add-book.php", "Something went wrong!", 'danger');
    }
} elseif (isset($_POST['update-book'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $price = $_POST['price'];
    $genre = isset($_POST["genre"]) ? $_POST["genre"] : null;
    $picture = $_POST['picture'];
    $isbn_code = $_POST['isbn_code'];
    $short_description = mysqli_real_escape_string($connect, $_POST['short_description']);
    $author_first_name = $_POST['author_first_name'];
    $author_last_name = $_POST['author_last_name'];
    $author_email = $_POST['author_email'];
    // $publisher_name = $_POST['publisher_name'];
    // $publisher_address = $_POST['publisher_address'];
    // $publisher_date = $_POST['publisher_date'];
    $picture = file_upload($_FILES['picture'], "book");
    mysqli_begin_transaction($connect);

    try {
        if ($picture->error === 0) {
            $sql = "UPDATE `book` SET `title`=?, `image`=?, `ISBN_code`=?, `short_description`=?, `price`=?, `genre_id`=? WHERE `id`=?";
            $stmt = $connect->prepare($sql);
            $stmt->bind_param("ssssdii", $title, $picture->fileName, $isbn_code, $short_description, $price, $genre, $id);
        } else {
            $sql = "UPDATE `book` SET `title`=?, `ISBN_code`=?, `short_description`=?, `price`=?, `genre_id`=? WHERE `id`=?";
            $stmt = $connect->prepare($sql);
            $stmt->bind_param("sssdii", $title, $isbn_code, $short_description, $price, $genre, $id);
        }
        $stmt->execute();
        $stmt->close();
        // Check and update or insert the author
        $stmt = $connect->prepare("SELECT id, first_name, last_name FROM `authors` WHERE email = ? LIMIT 1");
        $stmt->bind_param("s", $author_email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $existing_author = $result->fetch_assoc();
            $author_id = $existing_author['id'];
            if ($existing_author['first_name'] !== $author_first_name || $existing_author['last_name'] !== $author_last_name) {
                $stmt->close();
                $stmt = $connect->prepare("UPDATE `authors` SET first_name = ?, last_name = ? WHERE id = ?");
                $stmt->bind_param("ssi", $author_first_name, $author_last_name, $author_id);
                $stmt->execute();
                $stmt->close();
            }
        } else {
            $stmt->close();
            $stmt = $connect->prepare("INSERT INTO `authors` (first_name, last_name, email) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $author_first_name, $author_last_name, $author_email);
            $stmt->execute();
            $author_id = $stmt->insert_id;
            $stmt->close();
        }


        // Update books_authors relationship
        $updateRelSql = "INSERT INTO `books_authors` (book_id, author_id) VALUES (?, ?) ON DUPLICATE KEY UPDATE author_id = ?";
        $stmt = $connect->prepare($updateRelSql);
        $stmt->bind_param("iii", $id, $author_id, $author_id);
        $stmt->execute();
        $stmt->close();

        mysqli_commit($connect);
        redirect("update-book.php?id=" . $id, "Book updated successfully!");
    } catch (mysqli_sql_exception $exception) {
        var_dump($exception);
        return;
        mysqli_rollback($connect);
        redirect("update-book.php?id=" . $id, "Something went wrong!", 'danger');
    }
} else if (isset($_POST['delete-book'])) {
    $id = $_POST['id'];
    $book = getById('book', $id);
    $row = mysqli_fetch_assoc($book);
    $picture = $row['image'];
    if ($picture  != "book.jpg") {
        unlink("../../assets/img/$picture");
    }
    $sql = "DELETE FROM book WHERE id = {$id}";
    if (mysqli_query($connect, $sql) === TRUE) {
        redirect("../show-books.php", "Book deleted successfully!");
    } else {
        redirect("../show-books.php", "Something went wrong!");
    }
}
