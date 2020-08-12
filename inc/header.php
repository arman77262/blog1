<?php
    require_once 'config/config.php';
    require_once 'lib/Database.php';
    require_once 'helpers/Format.php';
    $db = new Database();
    $fr = new Format();
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">

    <?php
        if (isset($_GET['id'])){
            $keyword = base64_decode($_GET['id']);
            $query = "SELECT * FROM tbl_post WHERE id = '$keyword'";
            $select_tag = $db->select($query);
            if ($select_tag){
                while ($row = mysqli_fetch_assoc($select_tag)){
                    ?>
                    <meta name="keyword" content="<?=$row['tags']?>">
                    <?php
                }
            }
        }else{
            ?>
            <meta name="keyword" content="<?=METAKEY?>">
            <?php
        }
    ?>


    <?php
        if (isset($_GET['pageid'])){
            $pageid = $_GET['pageid'];
            $query = "SELECT * FROM tbl_page WHERE id='$pageid'";
            $result = $db->select($query);
            if ($result){
                while ($row = mysqli_fetch_assoc($result)){
                    ?>
                    <title><?=$row['title']?></title>
                    <?php
                }
            }
        }elseif (isset($_GET['id'])){
            $postid = $_GET['id'];
            $query = "SELECT * FROM tbl_post WHERE id='$postid'";
            $result = $db->select($query);
            if ($result){
                while ($row = mysqli_fetch_assoc($result)){
                    ?>
                    <title><?=$row['title']?></title>
                    <?php
                }
            }
        }
        else{
            ?>
            <title><?=$fr->title()?></title>
            <?php
        }
    ?>

    <!--carusal-->
    <link rel="stylesheet" href="slider/bootstrap.min.css">
    <script src="slider/jquery.min.js"></script>
    <script src="slider/popper.min.js"></script>
    <script src="slider/bootstrap.min.js"></script>
    <style>
        /* Make the image fully responsive */
        .carousel-inner img {
            width: 100%;
            height: 500px;
        }
    </style>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/blog-home.css" rel="stylesheet">


</head>

<body>

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <?php
            $query = "SELECT * FROM tbl_title WHERE id = '1'";
            $result = $db->select($query);
            if ($result){
                while ($rew = mysqli_fetch_assoc($result)){
                    ?>
                    <img src="admin/<?=$rew['logo']?>" width="50px" class="mr-2" alt="">
                    <a class="navbar-brand font-weight-bold" style="font-family: Stencil Std" href="index.php"><p><?=$rew['title']?></p></a>
                    <?php
                }
            }
        ?>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <?php
                $page = explode('/', $_SERVER['PHP_SELF']);
                $page = end($page);
            ?>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item <?=$page=='index.php'?'active':''?>">
                    <a class="nav-link" href="index.php">Home
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                <?php
                    $query = "SELECT * FROM tbl_page";
                    $result = $db->select($query);
                    if ($result){
                        while ($row = mysqli_fetch_assoc($result)){
                            ?>
                            <li class="nav-item">
                                <a class="nav-link <?=$_GET['pageid']==base64_encode($row['id'])?'active':''?>" href="page.php?pageid=<?=base64_encode($row['id'])?>"><?=$row['title']?></a>
                            </li>
                            <?php
                        }
                    }
                ?>

                <li class="nav-item">
                    <?php
                        $contact = "contact.php";
                    ?>
                    <a class="nav-link <?=$page==$contact?'active':''?>" href="<?php echo urlencode($contact)?>">Contact</a>
                </li>
            </ul>
        </div>
    </div>
</nav>