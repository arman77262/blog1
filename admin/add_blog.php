<?php require_once 'header.php'; ?>

<?php
if (isset($_POST['add_blog'])){
    $cat = $_POST['cat'];
    $title = $_POST['title'];
    $tags = $_POST['tags'];
    $author = $_POST['author'];
    $body = $_POST['body'];
    $userid = $_POST['userid'];

    $permiter = array('jpg','jpeg','png','gif');
    $file_name = $_FILES['image']['name'];
    $file_size = $_FILES['image']['size'];
    $file_tmp = $_FILES['image']['tmp_name'];

    $image = explode('.', $file_name);
    $file_ext = end($image);
    $image_name = substr(md5(time()), 0,10).'.'.$file_ext;
    $file_upload = "upload/".$image_name;

    if (empty($cat)){
        $cat_error = "Cat Must not be empty";
    }if (empty($title)){
        $title_error = "Title Must not be empty";
    }if (empty($tags)){
        $tag_error = "tags Must not be empty";
    }if (empty($author)){
        $auth_error = "author Must not be empty";
    }if (empty($body)){
        $body_error = "Text Area Must not be empty";
    }if (empty($file_name)){
        $img_error = "Image Fild Must Not Be Empty !";
    }elseif ($file_size > 1048567){
        $error = "Image size should be less than 1MB";
    }elseif (in_array($file_ext,$permiter)==false){
        $error = "You can upload onley:-".implode(',',$permiter);
    }else{
        move_uploaded_file($file_tmp, $file_upload);
        $query = "INSERT INTO `tbl_post`(`cat`, `title`, `body`, `image`, `author`, `tags`, `userid`) VALUES ('$cat','$title','$body','$file_upload','$author','$tags','$userid')";
        $inserted_rows = $db->insert($query);
        if ($inserted_rows){
            $success = "Post Added Successfully";
        }else{
            $error = "Post Not Added";
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
                    <div class="form-group row">
                        <label for="catagory_name " class="col-sm-2 col-form-label">Catagory Name</label>
                        <div class="col-sm-10">
                            <select name="cat" id="cat_id" class="form-control">
                                <option value="">Select Catagory</option>
                                <?php
                                $query = "SELECT * FROM tbl_category";
                                $result = $db->select($query);
                                while ($row = mysqli_fetch_assoc($result)){
                                    ?>
                                    <option value="<?=$row['id']?>"><?=$row['name']?></option>
                                    <?php
                                }
                                ?>
                            </select>
                            <?php
                            if (isset($cat_error)){
                                echo '<span class="text-danger">'.$cat_error.'</span>';
                            }
                            ?>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="blog_title" class="col-sm-2 col-form-label">Blog Title</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control"  name="title" id="blog_title " placeholder="Blog Title">
                            <?php
                            if (isset($title_error)){
                                echo '<span class="text-danger">'.$title_error.'</span>';
                            }
                            ?>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="blog_title" class="col-sm-2 col-form-label">Tags</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="tags" id="blog_title " placeholder="Blog Tags">
                            <?php
                            if (isset($tag_error)){
                                echo '<span class="text-danger">'.$tag_error.'</span>';
                            }
                            ?>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="blog_title" class="col-sm-2 col-form-label">Author</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="author" id="author " value="<?=Session::get('username')?>">
                            <input type="hidden" class="form-control" name="userid" id="author " value="<?=Session::get('userid')?>">
                            <?php
                            if (isset($auth_error)){
                                echo '<span class="text-danger">'.$auth_error.'</span>';
                            }
                            ?>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="content" class="col-sm-2 col-form-label">Blog Content</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" cols="60" name="body"></textarea>
                            <?php
                            if (isset($body_error)){
                                echo '<span class="text-danger">'.$body_error.'</span>';
                            }
                            ?>
                        </div>
                    </div>

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
                            <button type="submit" name="add_blog" class="btn btn-primary">Add Blog</button>
                        </div>
                    </div>
                </form>
            </div>
        </section>

    </div>
</div>

<?php require_once 'footer.php'?>
