<?php
session_start();
?>
<?php include('inc/header.php'); ?>
<div class="container">
    <a href="profile.php" class="btn btn-outline-primary rounded m-3">
        <i class="fas fa-arrow-alt-circle-left"></i> Back</a>
    <h1 class='display-3 text-center mb-4'>Gallery</h1>

    <?php
    require('config/config.php');
    require('config/db.php');

    $query = "SELECT * FROM imggallery";
    $result = mysqli_query($conn, $query);

    $infos = mysqli_fetch_all($result, MYSQLI_ASSOC);

    $email = $_SESSION['email'];

    echo "Your uploaded images are:  <br><br>";
    // <a href="#" class="btn btn-outline-danger">Delete</a>

    foreach ($infos as $info) {
        if ($info['email'] === $email) {
            echo  $info["imgTitle"]; ?>
            <a href="deleteImage.php?id=<?php echo $info["id"]; ?>" class="btn btn-outline-danger m-1">Delete</a>
        <?php
        }
    }
    ?>

</div>

<?php include('inc/footer.php'); ?>