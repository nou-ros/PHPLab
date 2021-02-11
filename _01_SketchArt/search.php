<?php include('inc/header.php'); ?>
<?php include('inc/nav.php'); ?>


<?php
require('config/config.php');
require('config/db.php');

if (isset($_POST['submit'])) {

    if (empty($_POST['search'])) {
        header("Location: home.php?error=emptyinsert");
        exit();
    }
    $search = mysqli_real_escape_string($conn, $_POST['search']);

    $sql = "SELECT * FROM imggallery WHERE imgTitle LIKE '%%$search%' ORDER BY imgOrder DESC;"; //as we like to search alike words 

    $result = mysqli_query($conn, $sql);
    $queryResult = mysqli_num_rows($result);
    ?>
    <div class="container my-3">
        <a href="home.php" class="btn btn-outline-primary rounded">
            <i class="fas fa-arrow-alt-circle-left"></i> Back</a>
        <h6 class='text-center text-info my-2'><?php echo $queryResult . " results found!" ?></h6>
        <div class="row">
            <div class="col-md">
                <div class="card-columns">
                    <?php
                    if ($queryResult > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '
            <div class="card mb-2">
             <img class="card-img-top" src="uploads/gallery/' . $row["imgFullName"] . '" alt="Card image" style="width:100%">
           <div class="card-body">
             <h4 class="card-title">' . $row["imgTitle"] . '</h4>
           <p class="card-text">' . $row["imgDescr"] . '</p>
           </div>
           </div>
     ';
                        }
                    } else {
                        echo "<h6 class='text-center text-warning my-2'>There are no results matching your search</h6><br>";
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>


<?php include('inc/footer.php'); ?>