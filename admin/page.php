<?php require_once 'header.php'; ?>

<?php
if (!isset($_GET['pageid']) || $_GET['pageid']==NULL){
    echo "<script>window.location='index.php'</script>";
}else{
    $pageid = $_GET['pageid'];
}
if (isset($_POST['update'])){
    $title = $_POST['title'];
    $body = $_POST['body'];

    if (empty($title)){
        $title_error = "Title Must not be empty";
    }if (empty($body)){
        $body_error = "Text Area Must not be empty";
    }else{
        $query = "UPDATE `tbl_page` SET `title`='$title',`body`='$body' WHERE `id`='$pageid'";
        $updated_rows = $db->update($query);
        if ($updated_rows){
            $success = "Page Updated Successfully";
        }else{
            $error = "Page Not Updated";
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
                Page Update Or Delete Form
            </header>
            <div class="card-body">
                <form method="post" action="" enctype="multipart/form-data">
                    <?php
                        $query = "SELECT * FROM tbl_page WHERE id='$pageid'";
                        $result = $db->select($query);
                        if ($result){
                            while ($row = mysqli_fetch_assoc($result)){
                                ?>
                                <div class="form-group row">
                                    <label for="blog_title" class="col-sm-2 col-form-label">Blog Title</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control"  name="title" id="blog_title " value="<?=$row['title']?>">
                                        <?php
                                        if (isset($title_error)){
                                            echo '<span class="text-danger">'.$title_error.'</span>';
                                        }
                                        ?>
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="content" class="col-sm-2 col-form-label">Blog Content</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" cols="60" name="body"><?=$row['body']?></textarea>
                                        <?php
                                        if (isset($body_error)){
                                            echo '<span class="text-danger">'.$body_error.'</span>';
                                        }
                                        ?>
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <button type="submit" name="update" class="btn btn-primary">Update</button>
                                        <a href="delete_page.php?delpage=<?=$row['id']?>" onclick="return confirm('Are You Sure Want To Delete This Page')" class="btn btn-danger">Delete Page</a>
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
