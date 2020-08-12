<?php require_once 'header.php'; ?>

<?php
if (isset($_POST['add_page'])){
    $title = $_POST['title'];
    $body = $_POST['body'];

   if (empty($title)){
        $title_error = "Title Must not be empty";
    }if (empty($body)){
        $body_error = "Text Area Must not be empty";
    }else{
        $query = "INSERT INTO `tbl_page`(`title`, `body`) VALUES ('$title','$body')";
        $inserted_rows = $db->insert($query);
        if ($inserted_rows){
            $success = "Page Created Successfully";
        }else{
            $error = "Page Not Created";
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
                Category Add Form
            </header>
            <div class="card-body">
                <form method="post" action="" enctype="multipart/form-data">
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
                        <div class="col-sm-10">
                            <button type="submit" name="add_page" class="btn btn-primary">Add Page</button>
                        </div>
                    </div>
                </form>
            </div>
        </section>

    </div>
</div>

<?php require_once 'footer.php'?>
