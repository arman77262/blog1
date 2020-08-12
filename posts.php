<?php
require_once 'inc/header.php';
if (!isset($_GET['category']) || $_GET['category']==NULL){
    echo "<script>window.location='404.php'</script>";
}else{
    $catid = base64_decode($_GET['category']);
}
$query = "SELECT * FROM tbl_post WHERE cat = '$catid'";
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
                    echo "<script>window.location='404.php'</script>";
                }
                ?>


            </div>

            <?php require_once 'inc/sidebar.php';?>


        </div>
        <!-- /.row -->

    </div>
    <!-- /.container -->

<?php require_once 'inc/footer.php';?>