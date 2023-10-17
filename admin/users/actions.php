<?php
include('../middlewares/admin-middleware.php');


function cleanInput($param)
{
    $clean = trim($param);
    $clean = strip_tags($clean);
    $clean = htmlspecialchars($clean);

    return $clean;
}

if (isset($_POST["add-user"])) {
    $error = false;

    $f_name = cleanInput($_POST["first_name"]);
    $l_name = cleanInput($_POST["last_name"]);
    $gender = cleanInput($_POST["gender"]);
    $birth_date = cleanInput($_POST["birth_date"]);
    $email = cleanInput($_POST["email"]);
    $password = cleanInput($_POST["password"]);
    $street = cleanInput($_POST["street"]);
    $city = cleanInput($_POST["city"]);
    $zip_code = cleanInput($_POST["zip_code"]);
    $state = cleanInput($_POST["state"]);
    $status = cleanInput($_POST["status"]);
    $picture = file_upload($_FILES['picture'], 'userM');

    if (empty($f_name)) {
        $error = true;
        $errMsg = "Please enter your first name";
    } elseif (strlen($f_name) < 3) {
        $error = true;
        $errMsg = "First name must have at least 3 chars";
    } elseif (!preg_match("/^[a-zA-Z]+$/", $f_name)) {
        $error = true;
        $errMsg = "First name must contain only letters and no spaces";
    }

    if (empty($l_name)) {
        $error = true;
        $errMsg = "Please enter your last name";
    } elseif (strlen($l_name) < 3) {
        $error = true;
        $errMsg = "Last name must have at least 3 chars";
    } elseif (!preg_match("/^[a-zA-Z]+$/", $l_name)) {
        $error = true;
        $errMsg = "Last name must contain only letters and no spaces";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = true;
        $errMsg = "please enter a valid email address";
    } else {
        $query = "SELECT email FROM users WHERE email = '$email' ";
        $result = mysqli_query($connect, $query);
        if (mysqli_num_rows($result) != 0) {
            $error = true;
            $errMsg = "Provided Email is already in use.";
        }
    }

    if (empty($birth_date)) {
        $error = true;
        $errMsg = "Please enter your date of birth.";
    }

    $gender = isset($_POST['gender']) ? cleanInput($_POST['gender']) : "";
    if (empty($gender)) {
        $errMsg = "Please select a gender.";
    }


    if (empty($state)) {
        $error = true;
        $errMsg = 'Please enter state';
    }
    if (empty($city)) {
        $error = true;
        $errMsg = 'Please enter city';
    }
    if (empty($street)) {
        $error = true;
        $errMsg = 'Please enter street';
    }
    if (empty($zip_code)) {
        $error = true;
        $errMsg = 'Please enter zip code';
    }
    if (empty($status)) {
        $error = true;
        $errMsg = 'Please select role of the user';
    }

    if (empty($password)) {
        $error = true;
        $errMsg = "Please enter password.";
    } elseif (strlen($password) < 6) {
        $error = true;
        $errMsg = "Password must have at least 6 characters.";
    }

    $password = hash("sha256", $password);

    if (!$error) {

        $sqlAddress = "INSERT INTO `address_code` (`city`, `state`, `zip_code`) VALUES ('$city', '$state', '$zip_code')";
        mysqli_query($connect, $sqlAddress);
        $addressCodeId = mysqli_insert_id($connect);


        $sql = "INSERT INTO `users`(`first_name`, `last_name`, `birth_date`, `gender`, `email`, `password`, `street_address`, `address_code_id`, `profile_picture`, `user_type`) VALUES ('$f_name','$l_name',' $birth_date','$gender','$email','$password','$street','$addressCodeId','$picture->fileName','$status')";

        if (mysqli_query($connect, $sql) === true) {
            $formSubmitted = true;
            redirect("add-user.php", "User added successfully!");
        } else {
            redirect("add-user.php", "test!");
        }
    }else{
        redirect("add-user.php", $errMsg,'danger');
    }
} elseif (isset($_POST["edit-profile"])) {
    $id = $_POST['id'];
    $f_name = $_POST['first_name'];
    $l_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $birth_date = $_POST['birth_date'];
    $status = $_POST['status'];
    $city = $_POST['city'];
    $street = $_POST['street'];
    $state = $_POST['state'];
    $zip_code = $_POST['zip_code'];
    $picture = file_upload($_FILES['picture'], 'userM');

    $password = hash("sha256", $password);


    if ($picture->error === 0) {
        ($_POST["picture"] == "user.jpg") ?: unlink("../../assets/img/$_POST[picture]");
        $sql = "UPDATE users AS u
            JOIN address_code AS ac ON u.address_code_id = ac.id
            SET u.first_name = '$f_name', u.last_name = '$l_name', u.email = '$email', 
            u.password = '$password', u.birth_date = '$birth_date', u.profile_picture = '$picture->fileName', 
            u.user_type = '$status', u.street_address = '$street', ac.city = '$city' , ac.zip_code = '$zip_code', 
            ac.state = '$state'
            WHERE u.id = $id";
    } else {
        $sql = "UPDATE users AS u
            JOIN address_code AS ac ON u.address_code_id = ac.id
            SET u.first_name = '$f_name', u.last_name = '$l_name', u.email = '$email', 
            u.password = '$password', u.birth_date = '$birth_date',
            u.user_type = '$status', u.street_address = '$street', ac.city = '$city', ac.zip_code = '$zip_code', 
            ac.state = '$state'
            WHERE u.id = $id";
    }
    if (mysqli_query($connect, $sql) === true) {
        redirect("edit-user.php?id=" . $id, "User updated successfully!");
    } else {
        redirect("edit-user.php?id=" . $id, "Something went wrong!");
    }
} else if ($_POST["delete-btn"]) {
    $id = $_POST['id'];
    $user = getById('users', $id);
    $row = mysqli_fetch_assoc($user);
    $picture = $row['profile_picture'];
    $addressCodeId = $row['address_code_id'];
    if ($picture  != "user.jpg") {
        unlink("../../assets/img/$picture");
    }
   
    $sql = "DELETE FROM users WHERE id = {$id}";
    $res = mysqli_query($connect, $sql);

    $sql1 = "DELETE FROM address_code WHERE id = {$addressCodeId }";
    if (mysqli_query($connect, $sql1) === TRUE) {
        echo "Success";
    } else {
        echo "Error";
    }
}