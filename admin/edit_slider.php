<?php require_once 'header.php'; ?>

<?php

if (!isset($_GET['slider_edit']) || $_GET['slider_edit'] == NULL){
    echo '<script>window.location="manage_blog.php"</script>';
}else{
    $id = $_GET['slider_edit'];
}

if (isset($_POST['update_slider'])){

    $status = $_POST['status'];

    $permiter = array('jpg','jpeg','png','gif');
    $file_name = $_FILES['image']['name'];
    $file_size = $_FILES['image']['size'];
    $file_tmp = $_FILES['image']['tmp_name'];

    $image = explode('.', $file_name);
    $file_ext = end($image);
    $image_name = substr(md5(time()), 0,10).'.'.$file_ext;
    $file_upload = "upload/slider/".$image_name;

        if (!empty($file_name)){
            if ($file_size > 1048567){
                $error = "Image size should be less than 1MB";
            }elseif (in_array($file_ext,$permiter)==false){
                $error = "You can upload onley:-".implode(',',$permiter);
            }else{
                move_uploaded_file($file_tmp, $file_upload);
                $query = "UPDATE `tbl_slider` SET `image`='$file_upload',`status`='$status' WHERE `id` = '$id'";
                $inserted_rows = $db->update($query);
                if ($inserted_rows){
                    $success = "Slider Update Successfully";
                }else{
                    $error = "Slider Not Update";
                }
            }
        }else{
            $query = "UPDATE `tbl_slider` SET `status`='$status' WHERE `id` = '$id'";
            $inserted_rows = $db->update($query);
            if ($inserted_rows){
                $success = "Slider Update Successfully";
            }else{
                $error = "Slider Not Update";
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
                Blog Add Form
            </header>
            <div class="card-body">
                <form method="post" action="" enctype="multipart/form-data">
                    <?php
                    $query = "SELECT * FROM tbl_slider WHERE id = '$id'";
                    $result = $db->select($query);
                    if ($result){
                        while ($postrow = mysqli_fetch_assoc($result)){
                            ?>
                            <div class="form-group row">
                                <label for="blog_title" class="col-sm-2 col-form-label">Blog Title</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control"  name="status" id="blog_title " value="<?=$postrow['status']?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="photo" class="col-sm-2 col-form-label">Photo</label>
                                <div class="col-sm-10">
                                    <img src="<?=$postrow['image']?>" style="width: 120px;" class="img-thumbnail" alt=""><br>
                                    <input type="file"  name="image" id="photo">
                                    <?php
                                    if (isset($img_error)){
                                        echo '<span class="text-danger">'.$img_error.'</span>';
                                    }
                                    ?>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-10">
                                    <button type="submit" name="update_slider" class="btn btn-primary">Update Slider</button>
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
