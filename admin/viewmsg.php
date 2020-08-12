<?php require_once 'header.php'; ?>

<?php

if (!isset($_GET['msgid']) || $_GET['msgid']==NULL){
    echo "<script>window.location='inbox.php'</script>";
}else{
    $msgid = $_GET['msgid'];
}

if (isset($_POST['submit'])){
    echo "<script>window.location='inbox.php'</script>";
}
?>

<div class="row">
    <div class="col-lg-12">
        <section class="card">
            <header class="card-header">
                Massage View From
            </header>
            <div class="card-body">
                <?php
                    $query = "SELECT * FROM tbl_contact WHERE id='$msgid'";
                    $select = $db->select($query);
                    if ($select){
                        while ($row = mysqli_fetch_assoc($select)){
                            ?>
                            <form method="post" action="" enctype="multipart/form-data">
                                <div class="form-group row">
                                    <label for="blog_title" class="col-sm-2 col-form-label">Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" readonly name="fname" id="blog_title " value="<?=$row['fname'].' '.$row['lname']?>">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="blog_title" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" readonly name="email" id="blog_title " value="<?=$row['email']?>">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="blog_title" class="col-sm-2 col-form-label">Date</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" readonly name="lname" id="blog_title " value="<?=$row['datetime']?>">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="content" class="col-sm-2 col-form-label">Massage</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" readonly cols="60" name="massage"><?=$row['msg']?></textarea>
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="content" class="col-sm-2 col-form-label"></label>
                                    <div class="col-sm-10">
                                        <button type="submit" name="submit" class="btn btn-primary">OK</button>
                                    </div>
                                </div>
                            </form>
                            <?php
                        }
                    }
                ?>

            </div>
        </section>

    </div>
</div>

<?php require_once 'footer.php'?>
