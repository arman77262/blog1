<?php require_once 'header.php'; ?>

<?php
if (isset($_POST['add_blog'])){

    $permiter = array('jpg','jpeg','png','gif');
    $file_name = $_FILES['image']['name'];
    $file_size = $_FILES['image']['size'];
    $file_tmp = $_FILES['image']['tmp_name'];

    $image = explode('.', $file_name);
    $file_ext = end($image);
    $image_name = substr(md5(time()), 0,10).'.'.$file_ext;
    $file_upload = "upload/slider/".$image_name;

    if (empty($file_name)){
        $img_error = "Image Fild Must Not Be Empty !";
    }elseif ($file_size > 1048567){
        $error = "Image size should be less than 1MB";
    }elseif (in_array($file_ext,$permiter)==false){
        $error = "You can upload onley:-".implode(',',$permiter);
    }else{
        move_uploaded_file($file_tmp, $file_upload);
        $query = "INSERT INTO `tbl_slider`(`image`) VALUES ('$file_upload')";
        $inserted_rows = $db->insert($query);
        if ($inserted_rows){
            $success = "Slider Added Successfully";
        }else{
            $error = "Slider Not Added";
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
                Slider Add Form
            </header>
            <div class="card-body">
                <form method="post" action="" enctype="multipart/form-data">
                    <div class="form-group row">
                        <label for="photo" class="col-sm-2 col-form-label">Photo</label>
                        <div class="col-sm-10">
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
                            <button type="submit" name="add_blog" class="btn btn-primary">Add Slider</button>
                        </div>
                    </div>
                </form>
            </div>
        </section>

    </div>
</div>

<?php require_once 'footer.php'?>
