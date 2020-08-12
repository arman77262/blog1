<?php
require_once 'config/config.php';
require_once 'lib/Database.php';
$db = new Database();
?>
<!-- Sidebar Widgets Column -->
<div class="col-md-4">

    <!-- Search Widget -->
    <div class="card my-4">
        <h5 class="card-header">Search</h5>
        <div class="card-body">
            <div class="input-group">
                <div class="panel-content">
                    <div class="row">
                        <form class="form-inline" action="search.php" method="get">
                            <input class="form-control mr-sm-2" required name="search" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Categories Widget -->
    <div class="card my-4">
        <h5 class="card-header">Categories</h5>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-6">
                    <ul class="list-unstyled mb-0">
                        <?php
                        $query = "SELECT * FROM tbl_category";
                        $result = $db->select($query);
                        if ($result){
                            while ($row = mysqli_fetch_assoc($result)){
                                ?>
                                <li>
                                    <a href="posts.php?category=<?=base64_encode($row['id'])?>"><?=$row['name']?></a>
                                </li>
                                <?php
                            }
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Side Widget -->
    <div class="card my-4">
        <h5 class="card-header">Side Widget</h5>
        <div class="card-body">
            <div class="samesidebar clear">
                <h2>Latest articles</h2>
                <?php
                $query = "SELECT * FROM `tbl_post` LIMIT 5";
                $post = $db->select($query);
                if ($post){
                    while ($row = mysqli_fetch_assoc($post)){
                        ?>
                        <div class="popular clear">
                            <h3><a href="post.php?id=<?=base64_encode($row['id'])?>"><?=$row['title']?></a></h3>
                            <a href="#"><img src="admin/<?=$row['image']?>" alt="post image"/></a>
                            <p><?php echo $fr->textShorten($row['body'],120)?></p>
                        </div>
                        <?php
                    }
                }else{
                    echo '<h1>Post Not Found</h1>';
                }
                ?>

            </div>
        </div>
    </div>

</div>