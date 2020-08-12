<?php require_once 'header.php';
if (isset($_POST['update'])){
    $title = $_POST['title'];

    $permition = array('png','jpg');
    $file_name = $_FILES['logo']['name'];
    $file_size = $_FILES['logo']['size'];
    $file_tmp = $_FILES['logo']['tmp_name'];

    $image = explode('.',$file_name);
    $img_ext = end($image);
    $logo_name = "logo".'.'.$img_ext;
    $upload_logo = "upload/".$logo_name;

    if (empty($title)){
        $title_error = "Title Fild Must Not Be Empty";
    }else{
        if (!empty($file_name)){
            if ($file_size > 1048567){
                $error = "Image size should be less than 1MB";
            }elseif (in_array($img_ext, $permition) == false){
                $error = "<span> You Can Upload Only :-".implode(','.$permition)."</span>";
            }else{
                move_uploaded_file($file_tmp, $upload_logo);
                $query = "UPDATE `tbl_title` SET `title`='$title',`logo`='$upload_logo' WHERE `id`='1'";
                $update_row = $db->update($query);
                if ($update_row){
                    $success = "Title Bar Updated Successfully";
                }else{
                    $error = "Something Wrong Titlebar is not updated";
                }
            }
        }else{
            $query = "UPDATE `tbl_title` SET `title`='$title' WHERE `id`='1'";
            $update_row = $db->update($query);
            if ($update_row){
                $success = "Title Bar Updated Successfully";
            }else{
                $error = "Something Wrong Titlebar is not updated";
            }
        }
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
                Category Add Form
            </header>
            <div class="card-body">
                <form method="post" enctype="multipart/form-data" action="">
                    <?php
                        $query = "SELECT * FROM tbl_title WHERE id ='1'";
                        $result = $db->select($query);
                        if ($result){
                            while ($row = mysqli_fetch_assoc($result)){
                                ?>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Title</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="title" id="inputEmail3" value="<?=$row['title']?>">
                                        <?php
                                        if (isset($title_error)){
                                            echo "<span class='text-danger'>$title_error</span>";
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Logo</label>
                                    <div class="col-sm-10">
                                        <img src="<?=$row['logo']?>" width="150px" class="img-thumbnail" alt="">
                                        <input type="file" class="form-control" name="logo">
                                        <?php
                                        if (isset($cat_error)){
                                            echo "<span class='text-danger'>$cat_error</span>";
                                        }
                                        ?>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <button type="submit" name="update" class="btn btn-primary">Update</button>
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
