<?php
session_start();

require('config/config.php');
require('config/db.php');

if (isset($_POST['submit'])) {

    $newFileName = $_POST['filename'];
    if (empty($_POST[$newFileName])) {
        $newFileName = "gallery";
    } else {
        $newFileName = strtolower(str_replace(" ", "-", $newFileName));
    }

    $imageTitle = $_POST['filetitle'];
    $imageDescr = $_POST['filedescr'];

    $email = $_SESSION['email'];

    //to get all the information about files we use $_FILES
    $file = $_FILES['file'];

    // print_r($file);
    $fileName = $file["name"];
    $fileTmpName = $file["tmp_name"];
    $fileSize = $file["size"];
    $fileError = $file["error"];
    $fileType = $file["type"];

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg', 'jpeg', 'png');

    if (in_array($fileActualExt, $allowed)) {
        if ($fileError === 0) {
            if ($fileSize < 10000000) {
                $imgFullName = $newFileName . "." . uniqid("", true) . "." . $fileActualExt;
                $dir = "uploads/gallery/";
                if (!is_dir($dir)) {
                    mkdir($dir, "0777", true);
                }
                $fileDestination = $dir . $imgFullName;

                if (empty($imageTitle) || empty($imageDescr)) {
                    header("Location: profile.php?upload=empty");
                    exit();
                } else {
                    $sql = "SELECT * FROM imggallery;";
                    $stmt = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($stmt, $sql)) {
                        echo "SQL statement failed!";
                    } else {
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);
                        $row = mysqli_num_rows($result);
                        $setImageOrder = $row + 1;

                        $sql = "INSERT INTO imggallery (imgTitle, imgDescr, imgFullName, imgOrder, email) VALUES (?, ?, ?, ?, ?);";

                        if (!mysqli_stmt_prepare($stmt, $sql)) {
                            echo "SQL statement failed!";
                        } else {
                            mysqli_stmt_bind_param($stmt, "sssss", $imageTitle, $imageDescr, $imgFullName, $setImageOrder, $email);
                            mysqli_stmt_execute($stmt);

                            move_uploaded_file($fileTmpName, $fileDestination);

                            header("Location: home.php?uploadsuccess");
                        }
                    }
                }
            } else {
                echo "Your file is too big";
            }
        } else {
            echo "There was an error uploading this file!";
        }
    } else {
        echo "You cannot upload this type of file";
    }
}
