<?php
if (isset($_POST['submit'])) {
    require('config/config.php');
    require('config/db.php');

    $email = $_POST['email'];
    $password = $_POST['passwd'];

    if (empty($email) || empty($password)) {
        header("Location: login.php?error=emptyfields");
        exit();
    } else {
        $sql = "SELECT * FROM signup WHERE email=?"; //if we want to add username also then OR username=?
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: index.php?error=sqlerror");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);

            $result = mysqli_stmt_get_result($stmt);

            if ($row = mysqli_fetch_assoc($result)) {
                $pwdCheck = password_verify($password, $row['passwd']);
                if ($pwdCheck == false) {
                    header("Location: login.php?error=wrongpasswd");
                    exit();
                } else if ($pwdCheck == true) {
                    session_start();

                    $_SESSION['id'] = $row['id'];
                    $_SESSION['email'] = $row['email'];

                    header("Location: home.php?login=success");
                    exit();
                } else {
                    header("Location: index.php?error=wrongpaswd");
                    exit();
                }
            } else {
                header("Location: index.php?error=nouser");
                exit();
            }
        }
    }
} else {
    header("Location: index.php");
    exit();
}
