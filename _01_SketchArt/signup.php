<?php include('inc/header.php'); ?>

<div class="container my-5">
    <a href="index.php" class="btn btn-outline-primary rounded m-2">
        <i class="fas fa-arrow-alt-circle-left"></i> Back</a>

    <h1 class="text-center display-3">Sign Up</h1>
    <?php
    if (isset($_GET["error"])) {
        if ($_GET["error"] == "emptyfields") {
            echo '<p class="my-3 text-danger text-center">Fill in all the fields!</p>';
        } else if ($_GET["error"] == "invalidnameandemail") {
            echo '<p class="my-3 text-warning text-center">Invalid names and email!</p>';
        } else if ($_GET["error"] == "invalidemail") {
            echo '<p class="my-3 text-danger text-center">Invalid e-mail!</p>';
        } else if ($_GET["error"] == "invalidname") {
            echo '<p class="my-3 text-warning text-center">Invalid Name!</p>';
        } else if ($_GET["error"] == "passwordcheck") {
            echo '<p class="my-3 text-warning text-center">Passwords do not match</p>';
        } else if ($_GET["error"] == "emailtaken") {
            echo '<p class="my-3 text-warning text-center">Email is already taken</p>';
        }
    }
    ?>
    <form action="signup.inc.php" method="POST" class="my-2">
        <div class="form-group">
            <label>Firstname</label>
            <input type="text" name="firstname" placeholder="Enter firstname" class="form-control">
        </div>
        <div class="form-group">
            <label>Lastname</label>
            <input type="text" name="lastname" placeholder="Enter lastname" class="form-control">
        </div>
        <div class="form-group">
            <label>Email Adress</label>
            <input type="email" name="email" placeholder="Enter email adress" class="form-control">
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="passwd" placeholder="Enter password" class="form-control">
        </div>
        <div class="form-group">
            <label>Repeat Password</label>
            <input type="password" name="passwd1" placeholder="Repeat password" class="form-control"><br>
        </div>
        <input type="submit" name="submit" value="Sign Up" class="btn btn-outline-primary">
    </form>
</div>

<?php include('inc/footer.php'); ?>