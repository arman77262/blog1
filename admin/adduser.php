<?php require_once 'header.php';

if (Session::get('userRole')==2){
    echo "<script>window.location='userlist.php'</script>";
}
if (Session::get('userRole')==3){
    echo "<script>window.location='userlist.php'</script>";
}

if (isset($_POST['add_cat'])){
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $email = $_POST['email'];
    $role = $_POST['role'];
    if (empty($username) || empty($password)||empty($role)){
        $error = "Fild Must Not Be Empty";
    }else{
        $query = "SELECT * FROM tbl_user WHERE email='$email' LIMIT 1";
        $mailCheck = $db->select($query);
        if ($mailCheck != false){
            $error = "Email Address Already Exsist";
        }else{
            $query = "INSERT INTO `tbl_user`(`username`, `password`, `email`, `role`) VALUES ('$username','$password','$email','$role')";
            $result = $db->insert($query);
            if ($result){
                $success = "User Added Successfully";
            }else{
                $error = "User Is Not Added";
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
                Add New User
            </header>
            <div class="card-body">
                <form method="post" action="">
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Username</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="username" id="inputEmail3" placeholder="Add Username">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="password" id="inputEmail3" placeholder="Password">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="email" id="inputEmail3" placeholder="Enter Email">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="cat_id " class="col-sm-2 col-form-label">Select Role</label>
                        <div class="col-sm-10">
                            <select name="role" id="cat_id" class="form-control">
                                <option value="">Select user role</option>
                                <option value="1">Admin</option>
                                <option value="2">Author</option>
                                <option value="3">Editor</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-10">
                            <button type="submit" name="add_cat" class="btn btn-primary">Add User</button>
                        </div>
                    </div>
                </form>
            </div>
        </section>

    </div>
</div>

<?php require_once 'footer.php'?>
