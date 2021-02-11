<?php
if (isset($_POST['submit'])) {
    require('config/config.php');
    require('config/db.php');

    $firstName = $_POST['firstname'];
    $lastName = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['passwd'];
    $passwordRepeat = $_POST['passwd1'];

    if (empty($firstName) || empty($lastName) || empty($email) || empty($password) || empty($passwordRepeat)) {
        header("Location: signup.php?error=emptyfields&firstname=" . $firstName . "&lastname=" . $lastName . "&email=" . $email);
        exit();
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", ($firstName && $lastName))) {
        header("Location: signup.php?error=invalidnameandemail&email=");
        exit();
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: signup.php?error=invalidemail&firstname=" . $firstName . "&lastname=" . $lastName);
        exit();
    } else if (!preg_match("/^[a-zA-Z0-9]*$/", ($firstName && $lastName))) {
        header("Location: signup.php?error=invalidname&email=" . $email);
        exit();
    } else if ($password !== $passwordRepeat) {
        header("Location: signup.php?error=passwordcheck&firstname=" . $firstName . "&lastname=" . $lastName . "&email=" . $em);
        exit();
    } else {
        //if email is already taken 
        //we will use prepared stament so users can not insert sql code inside our site
        $sql = "SELECT email FROM signup WHERE email=?"; // AND $Username=? if we also want to check user name
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: signup.php?error=sqlerror");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "s", $email); //string s, integer=i, blob=b, double= d
            mysqli_stmt_execute($stmt);

            //store the result now again in stmt 
            //also in fetching data we need this but not in insert
            mysqli_stmt_store_result($stmt);
            $result = mysqli_stmt_num_rows($stmt);

            if ($result > 0) {
                header("Location: signup.php?error=emailtaken&firstname=" . $firstName . "&lastname=" . $lastName);
                exit();
            } else {

                $sql = "INSERT INTO signup(firstName, lastName, email, passwd) VALUES(?, ?, ?, ?)";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: signup.php?error=sqlerror");
                    exit();
                } else {
                    //hash the password using bcrypt
                    $hashedPass = password_hash($password, PASSWORD_DEFAULT);

                    mysqli_stmt_bind_param($stmt, "ssss", $firstName, $lastName, $email, $hashedPass);
                    mysqli_stmt_execute($stmt);

                    header("Location: login.php?signup=success");
                    exit();
                }
            }
        }
    }

    //better to close database after using 
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}

//if try to access using /signup.php
else {
    header("Location: signup.php");
    exit();
}
