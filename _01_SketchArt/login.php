<?php include('inc/header.php'); ?>
<div class="container my-5">
    <a href="index.php" class="btn btn-outline-primary rounded m-2">
        <i class="fas fa-arrow-alt-circle-left"></i> Back</a>
</div>
<?php
if (isset($_GET["error"])) {
    if ($_GET["error"] == "emptyfields") {
        echo '<p class="my-3 text-danger text-center">Fill in all the fields!</p>';
    } else if ($_GET["error"] == "wrongpasswd") {
        echo '<p class="my-3 text-warning text-center">Wrong password!</p>';
    }
}
?>
<div class="container my-5">
    <h1 class="text-center display-3">Login Here</h1>
    <form action="login.inc.php" method="POST">
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" placeholder="Enter email" class="form-control">
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="passwd" placeholder="Enter password" class="form-control" id="myInput">
        </div>
        <br>
        <input type="submit" name="submit" value="Submit" class="btn btn-outline-primary rounded">
    </form>
</div>

<?php include('inc/footer.php'); ?>