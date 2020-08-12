<?php require_once 'header.php';
    if (isset($_POST['add_cat'])){
        $cat = $_POST['cat'];
        if (empty($cat)){
            $cat_error = "Category Fild Must Not Be Empty";
        }else{
            $query = "INSERT INTO `tbl_category`(`name`) VALUES ('$cat')";
            $result = $db->insert($query);
            if ($result){
                $success = "Category Added Successfully";
            }else{
                $error = "Category Is Not Added";
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
                                <input type="text" class="form-control" name="cat" id="inputEmail3" placeholder="Category Name">
                                <?php
                                    if (isset($cat_error)){
                                        echo "<span class='text-danger'>$cat_error</span>";
                                    }
                                ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-10">
                                <button type="submit" name="add_cat" class="btn btn-primary">Add Category</button>
                            </div>
                        </div>
                    </form>
                </div>
            </section>

        </div>
</div>

<?php require_once 'footer.php'?>
