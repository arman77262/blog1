<?php require_once 'header.php';
if (isset($_POST['update_copy'])){
    $sname = $_POST['sname'];
    $saddress = $_POST['saddress'];
    $mobile = $_POST['mobile'];

        $query = "UPDATE `tbl_footer` SET `sname`='$sname', `address`='$saddress', `mobile`='$mobile' WHERE `id`='1'";
        $result = $db->update($query);
        if ($result){
            $success = "Shop1 text Update Successfully";
        }else{
            $error = "Shop1 text is not Update";
        }
}
?>

<div class="row">
    <div class="col-lg-8">
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
                Shop Details
            </header>
            <div class="card-body">
                <form method="post" action="">
                    <?php
                        $query = "SELECT * FROM tbl_footer";
                        $result = $db->select($query);
                        if ($result){
                            while ($row = mysqli_fetch_assoc($result)){
                                ?>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Shop Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="sname" id="inputEmail3" value="<?=$row['sname']?>">
                                        <?php
                                        if (isset($cat_error)){
                                            echo "<span class='text-danger'>$cat_error</span>";
                                        }
                                        ?>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Shop Address</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="saddress" id="inputEmail3" value="<?=$row['address']?>">
                                        <?php
                                        if (isset($cat_error)){
                                            echo "<span class='text-danger'>$cat_error</span>";
                                        }
                                        ?>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Phone Number</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="mobile" pattern="01[1|8|5|6|9|7][0-9]{8}" id="inputEmail3" value="<?=$row['mobile']?>">
                                        <?php
                                        if (isset($cat_error)){
                                            echo "<span class='text-danger'>$cat_error</span>";
                                        }
                                        ?>
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <button type="submit" name="update_copy" class="btn btn-primary">Update</button>
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
