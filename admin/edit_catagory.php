<?php require_once 'header.php';
if (!isset($_GET['catid']) || $_GET['catid'] == NULL){
    echo "<script>window.location='manage_category.php'</script>";
}else{
    $id = $_GET['catid'];
}
if (isset($_POST['edit_cat'])){
    $cat = $_POST['cat'];
    if (empty($cat)){
        $cat_error = "Category Fild Must Not Be Empty";
    }else{
        $query = "UPDATE `tbl_category` SET `name`= '$cat' WHERE `id`='$id'";
        $result = $db->update($query);
        if ($result){
            $success = "Category Update Successfully";
        }else{
            $error = "Category Is Not Updated";
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
                <form method="post" action="">
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Category</label>
                        <div class="col-sm-10">
                            <?php
                                $query = "SELECT * FROM tbl_category WHERE id='$id'";
                                $result = $db->select($query);
                                if ($result){
                                    while ($row = mysqli_fetch_assoc($result)){
                                        ?>
                                        <input type="text" class="form-control" name="cat" id="inputEmail3" value="<?=$row['name']?>">
                                        <?php
                                    }
                                }
                            ?>

                            <?php
                            if (isset($cat_error)){
                                echo "<span class='text-danger'>$cat_error</span>";
                            }
                            ?>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-10">
                            <button type="submit" name="edit_cat" class="btn btn-primary">Update Category</button>
                        </div>
                    </div>
                </form>
            </div>
        </section>

    </div>
</div>

<?php require_once 'footer.php'?>
