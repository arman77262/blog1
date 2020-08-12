<?php require_once 'header.php'; ?>

<?php
$userid = Session::get('userid');
$userrole = Session::get('userRole');

if (isset($_POST['update_user'])){
    $name = mysqli_real_escape_string($db->link, $_POST['name']);
    $username = mysqli_real_escape_string($db->link, $_POST['username']);
    $email = mysqli_real_escape_string($db->link, $_POST['email']);
    $details = mysqli_real_escape_string($db->link, $_POST['details']);

    if (empty($name) || empty($username) || empty($email) || empty($details)){
        $error = "Fild Must Not Be Empty";
    }else{
        $query = "SELECT * FROM tbl_user WHERE email = '$email' LIMIT 1";
        $mail_check = $db->select($query);
        if ($mail_check != false){
           $error = "Email Address Already Exsist Try Another";
        }else{
            $query="UPDATE `tbl_user` SET `name`='$name',`username`='$username',`email`='$email',`details`='$details' WHERE `id`='$userid'";
            $inserted_rows = $db->update($query);
            if ($inserted_rows){
                $success = "User Update Successfully";
            }else{
                $error = "User Not Update";
            }
        }

        }


}
?>

<div class="row">
    <div class="col-lg-12">
        <section class="card">
            <?php
            if (isset($error)){
                ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <?=$error?>
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
                User Profile
            </header>
            <div class="card-body">
                <form method="post" action="" enctype="multipart/form-data">
                    <?php
                    $query = "SELECT * FROM tbl_user WHERE id='$userid' AND role='$userrole'";
                    $result = $db->select($query);
                    if ($result){
                        while ($postrow = mysqli_fetch_assoc($result)){
                            ?>

                            <div class="form-group row">
                                <label for="blog_title" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control"  name="name" id="blog_title " value="<?=$postrow['name']?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="blog_title" class="col-sm-2 col-form-label">Username</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="username" id="blog_title " value="<?=$postrow['username']?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="blog_title" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" name="email" id="author "value="<?=$postrow['email']?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="content" class="col-sm-2 col-form-label">Details</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" cols="60" name="details"><?=$postrow['details']?></textarea>
                                </div>
                            </div>


                            <div class="form-group row">
                                <div class="col-sm-10">
                                    <button type="submit" name="update_user" class="btn btn-primary">Update</button>
                                </div>
                            </div>
                            <?php
                        }
                    }
                    ?>

                </form>
            </div>
        </section>

    </div>
</div>

<?php require_once 'footer.php'?>
