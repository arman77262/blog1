<?php require_once 'header.php'; ?>

<?php

if (!isset($_GET['msgid']) || $_GET['msgid']==NULL){
    echo "<script>window.location='inbox.php'</script>";
}else{
    $msgid = $_GET['msgid'];
}

if (isset($_POST['submit'])){
    $to = mysqli_real_escape_string($db->link, $_POST['toemail']);
    $from = mysqli_real_escape_string($db->link, $_POST['fromemail']);
    $subject = mysqli_real_escape_string($db->link, $_POST['subject']);
    $msg = mysqli_real_escape_string($db->link, $_POST['body']);

    $sendmail = mail($to, $subject, $msg, $from);
    if ($sendmail){
        $success = "Message Send Successfully";
    }else{
        $error = "Something Wrong Massage Not Send";
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
                                <label for="blog_title" class="col-sm-2 col-form-label">To</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" readonly name="toemail" id="blog_title " value="<?=$row['email']?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="blog_title" class="col-sm-2 col-form-label">From</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" name="fromemail" id="blog_title">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="blog_title" class="col-sm-2 col-form-label">Subject</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="subject" id="blog_title">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="content" class="col-sm-2 col-form-label">Massage</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" cols="60" name="body"></textarea>
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="content" class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <button type="submit" name="submit" class="btn btn-primary">Replay</button>
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
