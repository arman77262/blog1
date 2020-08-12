<?php
require_once 'inc/header.php';
if (!isset($_GET['pageid']) || $_GET['pageid'] == NULL){
    header("location:404.php");
}else{
    $id = base64_decode($_GET['pageid']);
}
$query = "SELECT * FROM tbl_page WHERE id='$id'";
$post = $db->select($query);
?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
                <br>
                <?php
                if ($post){
                    while ($row = mysqli_fetch_assoc($post)){
                        ?>
                        <!-- Blog Post -->
                        <div class="card mb-4">
                            <div class="card-body">
                                <h2 class="card-title"><?=$row['title']?></h2>
                                <hr>
                                <p class="card-text" style="text-align: justify"><?=$row['body']?></p>
                            </div>
                        </div>
                        <?php
                    }
                }else{

                }
                ?>


            </div>

            <?php require_once 'inc/sidebar.php';?>


        </div>
        <!-- /.row -->

    </div>
    <!-- /.container -->

<?php require_once 'inc/footer.php';?>