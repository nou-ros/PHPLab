<?php include('inc/header.php'); ?>
<?php include('inc/nav.php'); ?>

<div class="container mt-5">
    <div class="d-flex justify-content-center mb-4">
        <form action="search.php" method="POST">
            <input type="text" name="search" placeholder=" Search..."><button type="submit" class="btn-primary" name="submit"><i class="fas fa-search "></i></button>
        </form>
    </div>

    <?php
    if (isset($_GET["error"]) == "emptyinsert") {
        echo "<h6 class='text-center text-danger'>Please insert something!</h6>";
    }
    ?>
    <!-- <h2 class="text-center my-3">Sketch Art</h2> -->
    <div class="row">
        <div class="col-md">
            <div class="card-columns">
                <?php

                require('config/config.php');
                require('config/db.php');

                $sql = "SELECT * FROM imggallery ORDER BY imgOrder DESC";

                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    echo "SQL statement failed!";
                } else {
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);

                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '
            <div class="card m-2">
              <img class="card-img-top" src="uploads/gallery/' . $row["imgFullName"] . '" alt="Card image" style="width:100%">
            <div class="card-body">
              <h4 class="card-title">' . $row["imgTitle"] . '</h4>
            <p class="card-text">' . $row["imgDescr"] . '</p>
            </div>
            </div>
           
      ';
                    }
                }

                ?>
            </div>
        </div>
    </div>

</div>

<?php include('inc/footer.php'); ?>