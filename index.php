<?php
    require_once 'inc/header.php';
    $per_page = 3;
    if (isset($_GET['page'])){
        $page = $_GET['page'];
    }else{
        $page = 1;
    }
    $page_start_from = ($page-1)*$per_page;
    $query = "SELECT * FROM tbl_post LIMIT $page_start_from,$per_page";
    $post = $db->select($query);
?>

    <div class="carusal">
        <div id="demo" class="carousel slide" data-ride="carousel">

            <!-- Indicators -->
            <ul class="carousel-indicators">
                <li data-target="#demo" data-slide-to="0" class="active"></li>
                <li data-target="#demo" data-slide-to="1"></li>
                <li data-target="#demo" data-slide-to="2"></li>
                <li data-target="#demo" data-slide-to="3"></li>
                <li data-target="#demo" data-slide-to="4"></li>
                <li data-target="#demo" data-slide-to="5"></li>
            </ul>

            <!-- The slideshow -->
            <div class="carousel-inner">
                <?php
                    $query = "SELECT * FROM tbl_slider";
                    $select = $db->select($query);
                    if ($query){
                        while ($row = mysqli_fetch_assoc($select)){
                            if ($row['status'] == 1){
                                ?>
                                <div class="carousel-item active">
                                    <img src="admin/<?=$row['image']?>" alt="Los Angeles" width="1100" height="500">
                                </div>
                                <?php
                            }else{
                                ?>
                                <div class="carousel-item">
                                    <img src="admin/<?=$row['image']?>" alt="Chicago" width="1100" height="500">
                                </div>
                                <?php
                            }
                        }
                    }
                ?>


            </div>

            <!-- Left and right controls -->
            <a class="carousel-control-prev" href="#demo" data-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </a>
            <a class="carousel-control-next" href="#demo" data-slide="next">
                <span class="carousel-control-next-icon"></span>
            </a>
        </div>
    </div>
  <!-- Page Content -->
  <div class="container">
    <div class="row">

      <!-- Blog Entries Column -->
      <div class="col-md-8">

        <!--<h1 class="my-4">Page Heading
          <small>Secondary Text</small>
        </h1>-->
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
                            <p class="card-text text-justify"><?=$fr->textShorten($row['body'])?></p>
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

            }
          ?>




        <!-- Pagination -->
          <?php
          $query = "SELECT * FROM tbl_post";
          $post = $db->select($query);
          $total_row = mysqli_num_rows($post);
          $total_page = ceil($total_row/$per_page);
          ?>
          <ul class="pagination justify-content-center mb-4">
              <li class="page-item">
                  <a class="page-link" href="index.php?page=1">&larr; Older</a>
              </li>
              <?php
              for ($i = 1; $i<=$total_page; $i++){
                  ?>
                  <li class="page-item">
                      <a class="page-link" href="index.php?page=<?=$i?>"><?=$i?></a>
                  </li>
                  <?php
              }
              ?>
              <li class="page-item">
                  <a class="page-link" href="index.php?page=<?=$total_page?>">Newer &rarr;</a>
              </li>
          </ul>
          <?php
          ?>

      </div>

        <?php require_once 'inc/sidebar.php';?>


    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->

<?php require_once 'inc/footer.php';?>