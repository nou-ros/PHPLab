<?php
require('config/config.php');
require('config/db.php');

?>
<?php include('inc/header.php'); ?>

<div class="container my-5">
  <div class="display-3 text-center ">
    <a class="text-info" style="text-decoration: none;" href="<?php echo ROOT_URL; ?>">Sketch Art</a>
  </div>

  <div class="text-center">
    <h1 class="my-5 display-3">Are you a member already?</h1>
    <a class="btn btn-outline-primary rounded" href="login.php">Login<br /><i class="fas fa-sign-in-alt"></i></a>
    <h5 class="m-2">OR</h5>
    <a class="btn btn-outline-primary rounded" href="signup.php">Sign Up<br /><i class="fas fa-user-plus"></i></a>
  </div>
</div>

<?php include('inc/footer.php'); ?>