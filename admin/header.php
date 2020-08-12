<?php
ob_start();
require_once '../lib/Session.php';
Session::checkSession();
require_once '../config/config.php';
require_once '../lib/Database.php';
require_once '../helpers/Format.php';

$db = new Database();
$fr = new Format();


$page = explode('/', $_SERVER['PHP_SELF']);
$page = end($page);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Mosaddek">
    <meta name="keyword" content="FlatLab, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <link rel="shortcut icon" href="img/favicon.html">

    <title>Admin</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-reset.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />

    <!--dynamic table-->
    <link href="assets/advanced-datatable/media/css/demo_table.css" rel="stylesheet" />
    <link rel="stylesheet" href="assets/data-tables/DT_bootstrap.css" />
    <!--right slidebar-->
    <link href="css/slidebars.css" rel="stylesheet">
    <!--  summernote -->
    <link href="assets/summernote/dist/summernote.css" rel="stylesheet">
    <!-- Custom styles for this template -->

    <link href="css/style.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet" />

</head>

<body>

<section id="container">
    <!--header start-->
    <header class="header white-bg">
        <div class="sidebar-toggle-box">
            <i class="fa fa-bars"></i>
        </div>
        <!--logo start-->
        <a href="../index.php" class="logo">Rana<span> Enterprise</span></a>
        <!--logo end-->
        <div class="top-nav ">
            <!--search & user info start-->
            <ul class="nav pull-right top-menu">
                <li>
                    <input type="text" class="form-control search" placeholder="Search">
                </li>
                <!-- user login dropdown start-->
                <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="username"><?=Session::get('username')?></span>
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu extended logout dropdown-menu-right">
                        <div class="log-arrow-up"></div>
                        <li class="text-center"><a href="profile.php"><i class=" fa fa-suitcase"></i>Profile</a></li>
                        <?php
                        if (isset($_GET['action']) && $_GET['action'] == 'logout'){
                            Session::destroy();
                        }
                        ?>
                        <li><a href="?action=logout"><i class="fa fa-key"></i> Log Out</a></li>
                    </ul>
                </li>
                <li class="sb-toggle-right">
                    <i class="fa  fa-align-right"></i>
                </li>
                <!-- user login dropdown end -->
            </ul>
            <!--search & user info end-->
        </div>
    </header>
    <!--header end-->
    <!--sidebar start-->
    <aside>
        <div id="sidebar"  class="nav-collapse ">
            <!-- sidebar menu start-->
            <ul class="sidebar-menu" id="nav-accordion">
                <li>
                    <a class="<?=$page=='index.php'?'active':''?>" href="index.php">
                        <i class="fa fa-dashboard"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li>
                    <a class="<?=$page=='inbox.php'?'active':''?>" href="inbox.php">
                        <i class="fa fa-inbox"></i>
                        <span>Inbox
                            <?php
                                $query ="SELECT * FROM tbl_contact WHERE status = '0'";
                                $select = $db->select($query);
                                if ($select){
                                    $count = mysqli_num_rows($select);
                                    echo "($count)";
                                }else{
                                    echo "(0)";
                                }
                            ?>
                        </span>
                    </a>
                </li>


                <li class="sub-menu">
                    <a href="javascript:" class="<?=$page=='add_category.php'?'active':'' || $page=='manage_category.php'?'active':''?>">
                        <i class="fa fa-laptop"></i>
                        <span>Catagories</span>
                    </a>
                    <ul class="sub">
                        <li class="<?=$page=='add_category.php'?'active':''?>"><a  href="add_category.php">Add Catagory</a></li>
                        <li class="<?=$page=='manage_category.php'?'active':''?>"><a  href="manage_category.php">Manage Catagory</a></li>
                    </ul>
                </li>

                <li class="sub-menu">
                    <a href="javascript:" class="<?=$page=='addslider.php'?'active':'' || $page=='sliderlist.php'?'active':''?>">
                        <i class="fa fa-laptop"></i>
                        <span>Slider</span>
                    </a>
                    <ul class="sub">
                        <li class="<?=$page=='addslider.php'?'active':''?>"><a  href="addslider.php">Add Slider</a></li>
                        <li class="<?=$page=='sliderlist.php'?'active':''?>"><a  href="sliderlist.php">Manage Slider</a></li>
                    </ul>
                </li>

                <!--Users Option start-->
                <li class="sub-menu">
                    <a href="javascript:" class="<?=$page=='adduser.php'?'active':''
                    || $page=='userlist.php'?'active':'' || $page=='profile.php'?'active':''?>">
                        <i class="fa fa-laptop"></i>
                        <span>Users Option</span>
                    </a>
                    <ul class="sub">
                        <?php
                            if (Session::get('userRole')==1){
                                ?>
                                <li class="<?=$page=='adduser.php'?'active':''?>"><a  href="adduser.php">Add New User</a></li>
                                <?php
                            }
                        ?>
                        <li class="<?=$page=='profile.php'?'active':''?>"><a  href="profile.php">User Profile</a></li>
                        <li class="<?=$page=='userlist.php'?'active':''?>"><a  href="userlist.php">User List</a></li>
                    </ul>
                </li>
                <!--Users Option end-->

                <li class="sub-menu">
                    <a href="javascript:" class="<?=$page=='title_slogan.php'?'active':'' || $page=='footer_copyright.php'?'active':'' || $page=='shoptwo.php'?'active':''?>">
                        <i class="fa fa-laptop"></i>
                        <span>Shop Option</span>
                    </a>
                    <ul class="sub">
                        <li class="<?=$page=='title_slogan.php'?'active':''?>"><a  href="title_slogan.php">Title Slogan</a></li>
                        <li class="<?=$page=='footer_copyright.php'?'active':''?>"><a  href="footer_copyright.php">Shop One</a></li>
                        <li class="<?=$page=='shoptwo.php'?'active':''?>"><a  href="shoptwo.php">Shop Two</a></li>
                    </ul>
                </li>

                <li class="sub-menu">
                    <a href="javascript:" class="<?=$page=='add_blog.php'?'active':'' || $page=='manage_blog.php'?'active':''?>">
                        <i class="fa fa-laptop"></i>
                        <span>Blog</span>
                    </a>
                    <ul class="sub">
                        <li class="<?=$page=='add_blog.php'?'active':''?>"><a  href="add_blog.php">Add Blog</a></li>
                        <li class="<?=$page=='manage_blog.php'?'active':''?>"><a  href="manage_blog.php">Manage Blog</a></li>
                    </ul>
                </li>

                <!--pages-->

                <li class="sub-menu">
                    <a href="javascript:" class="<?=$page=='addpage.php'?'active':''||$_GET['pageid']?'active':''?>">
                        <i class="fa fa-laptop"></i>
                        <span>Pages</span>
                    </a>
                    <ul class="sub">
                        <li class="<?=$page=='addpage.php'?'active':''?>"><a  href="addpage.php">Add New Page</a></li>
                        <?php
                        $query = "SELECT * FROM tbl_page";
                        $result = $db->select($query);
                        if ($result){
                        while ($row = mysqli_fetch_assoc($result)){
                        ?>
                        <li class="<?=$_GET['pageid']==$row['id']?'active':''?>"><a href="page.php?pageid=<?=$row['id']?>"><?=$row['title']?></a></li>
                            <?php
                        }
                        }
                        ?>
                    </ul>
                </li>

            </ul>
            <!-- sidebar menu end-->
        </div>
    </aside>
    <!--sidebar end-->
    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">