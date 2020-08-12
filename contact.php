<?php
require_once 'inc/header.php';
?>
<?php
    if (isset($_POST['submit'])){
        $fname = mysqli_real_escape_string($db->link, $_POST['fname']);
        $lname = mysqli_real_escape_string($db->link, $_POST['lname']);
        $emali = mysqli_real_escape_string($db->link, $_POST['email']);
        $msg = mysqli_real_escape_string($db->link, $_POST['massage']);

        $error = "";
        if (empty($fname)){
            $error = "First Name Fild Must Not Be Empty";
        }elseif (empty($lname)){
            $error = "Last Name Fild Must Not Be Empty";
        }elseif (empty($emali)){
            $error = "Email Fild Must Not Be Empty";
        }elseif (!filter_var($emali, FILTER_VALIDATE_EMAIL)){
            $error = "Invalid Email Address";
        }elseif (empty($msg)){
            $error = "Massage Fild Must Not Be Empty";
        }else{
            $query = "INSERT INTO `tbl_contact`(`fname`, `lname`, `email`, `msg`) VALUES ('$fname','$lname','$emali','$msg')";
            $insert_row = $db->insert($query);
            if ($insert_row){
                $success = "Massage Send Successfully";
            }else{
                $msg_error = "Something Wrong Massage Not Send";
            }
        }
    }
?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
                <br>
                <section class="card">
                    <?php
                    if (isset($msg_error)){
                        ?>
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <?=$msg_error?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <?php
                    }
                    ?>
                    <?php
                    if (isset($success)){
                        ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?=$success?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <?php
                    }
                    ?>
                    <header class="card-header">
                        <strong>Contact Us</strong>
                    </header>
                    <div class="card-body">
                        <?php
                        if (isset($error)){
                            echo "<span class='text-danger'>$error</span>";
                        }
                        ?>
                        <form method="post" action="" enctype="multipart/form-data">

                            <div class="form-group row">
                                <label for="blog_title" class="col-sm-2 col-form-label">First Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control"  name="fname" id="blog_title " placeholder="Enter Your First Name">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="blog_title" class="col-sm-2 col-form-label">Lsat Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control"  name="lname" id="blog_title " placeholder="Enter Your Last Name">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="blog_title" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control"  name="email" id="blog_title " placeholder="Enter Your Email">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="content" class="col-sm-2 col-form-label">Massage</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" cols="60" name="massage"></textarea>
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="content" class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <button type="submit" name="submit" class="btn btn-primary">Send</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </section>

            </div>

            <?php require_once 'inc/sidebar.php';?>


        </div>
        <!-- /.row -->

    </div>
    <!-- /.container -->

<?php require_once 'inc/footer.php';?>