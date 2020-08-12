<?php
require_once 'inc/header.php';
if (!isset($_GET['search']) || $_GET['search'] == NULL){
    echo '<h1 class="text-danger">Search Result Is Not Found</h1>';
}else{
    $search = $_GET['search'];
}
$query = "SELECT * FROM tbl_post WHERE title LIKE '%$search%' OR body LIKE '%$search%'";
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
                            <img class="card-img-top" src="admin/<?=$row['image']?>" alt="Card image cap">
                            <div class="card-body">
                                <h2 class="card-title"><?=$row['title']?></h2>
                                <p class="card-text"><?=$fr->textShorten($row['body'])?></p>
                                <a href="post.php?id=<?=base64_encode($row['id'])?>" class="btn btn-primary">Read More &rarr;</a>
                            </div>
                            <div class="card-footer text-muted">
                                <?=$fr->formatedate($row['datetime'])?> by
                                <a href="#"><?=$row['author']?></a>
                            </div>
                        </div>
                        <?php
                    }
                }else{
                    echo '<h1 class="text-danger">Search Result Is Not Found</h1>';
                }
                ?>


            </div>

            <?php require_once 'inc/sidebar.php';?>


        </div>
        <!-- /.row -->

    </div>
    <!-- /.container -->

<?php require_once 'inc/footer.php';?>