<?php
session_start();

require('config/config.php');
require('config/db.php');

$query = "SELECT * FROM signup";

$result = mysqli_query($conn, $query);

$infos = mysqli_fetch_all($result, MYSQLI_ASSOC);

mysqli_free_result($result);

mysqli_close($conn);


?>
<?php include('inc/header.php'); ?>
<?php include('inc/nav.php'); ?>

<section id="profile">
    <div class="container my-4">
        <a href="home.php" class="btn btn-outline-primary rounded">
            <i class="fas fa-arrow-alt-circle-left"></i> Back</a>
        <a href="edit.php" class="btn btn-outline-primary rounded float-right">Edit <i class="fas fa-arrow-alt-circle-right"></i></a>
        <div class="d-flex justify-content-md-center">

            <div class="card p-2">
                <div class="row no-gutters">
                    <div class="col-auto">
                        <img src="img/local.jpg" style="width: 200px; height: 150px" class="img-fluid mx-1" alt="">
                    </div>
                    <div class="col">
                        <div class="card-block px-1">
                            <?php

                            $email = $_SESSION['email'];

                            foreach ($infos as $info) {
                                if ($info['email'] === $email) {
                                    echo "Firstname: " . $info['firstName'] . "<br>";
                                    echo "Lastname: " . $info['lastName'] . "<br>";
                                    echo "Email: " . $info['email'] . "<br><br>";
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>

<section id="upload">
    <div class="container my-4">
        <h3 class="text-center text-info">Upload your image here!</h3>
        <div class="row">
            <div class="col-md-10 my-2">
                <form action="upload.inc.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Image Name</label>
                        <input type="text" name="filename" placeholder="Image name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Image Title</label>
                        <input type="text" name="filetitle" placeholder="Image title" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Image Description</label>
                        <textarea name="filedescr" placeholder="Image description" class="form-control"> </textarea>
                    </div>
                    <div class="form-group">
                        <input type="file" name="file">
                    </div>
                    <input class=" float-right btn btn-outline-primary rounded" type="submit" name="submit" value="Upload">
                </form>
            </div>
        </div>
    </div>
</section>
<?php include('inc/footer.php'); ?>