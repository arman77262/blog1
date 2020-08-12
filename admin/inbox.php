<?php
require_once 'header.php';

//code for send in seen box
if (isset($_GET['seenid'])){
    $seenid = $_GET['seenid'];
    $query = "UPDATE `tbl_contact` SET `status`='1' WHERE `id`='$seenid'";
    $update = $db->update($query);
    if ($update){
        $success = "Massage send into seen box";
    }else{
        $error = "Something Wrong massage not go to seen box";
    }
}

//delete seen massage
if (isset($_GET['delid'])){
    $delid = $_GET['delid'];
    $query = "DELETE FROM `tbl_contact` WHERE `id`='$delid'";
    $delete = $db->delete($query);
}
?>


    <div class="row">
        <div class="col-sm-12">
            <section class="card">

                <header class="card-header">
                    Inbox
                    <span class="tools pull-right">
                        <a href="javascript:" class="fa fa-chevron-down"></a>
                        <a href="javascript:" class="fa fa-times"></a>
                    </span>
                </header>
                <div class="card-body">
                    <div class="adv-table">
                        <table  class="display table table-bordered table-striped" id="dynamic-table">
                            <thead>
                            <tr>
                                <th>Sl No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Massege</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $query = "SELECT * FROM `tbl_contact` WHERE status='0' ORDER BY `id` DESC";
                            $select = $db->select($query);
                            $sl = 1;
                            if ($select){
                                while($row = mysqli_fetch_assoc($select)){
                                    ?>
                                    <tr>
                                        <td><?=$sl?></td>
                                        <td><?=$row['fname'].' '.$row['lname']?></td>
                                        <td><?=$row['email']?></td>
                                        <td><?=$fr->textShorten($row['msg'],40)?></td>
                                        <td><?=$fr->formatedate($row['datetime'])?></td>
                                        <td>
                                            <a href="viewmsg.php?msgid=<?=$row['id']?>" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i> View</a>
                                            <a href="replaymsg.php?msgid=<?=$row['id']?>" class="btn btn-success btn-sm"><i class="fa fa-reply"></i> Reply</a>
                                            <a href="?seenid=<?=$row['id']?>" class="btn btn-danger btn-sm"><i class="fa fa-eye-slash"></i> Seen</a>
                                        </td>
                                    </tr>
                                    <?php
                                    $sl++;
                                }
                            }

                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </div>

        <!--seen-->

        <div class="col-sm-12">
            <section class="card">
                <header class="card-header">
                    Seen Massage
                    <span class="tools pull-right">
                        <a href="javascript:" class="fa fa-chevron-down"></a>
                        <a href="javascript:" class="fa fa-times"></a>
                    </span>
                </header>
                <div class="card-body">
                    <div class="adv-table">
                        <table  class="display table table-bordered table-striped" id="dynamic-table">
                            <thead>
                            <tr>
                                <th>Sl No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Massege</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $query = "SELECT * FROM `tbl_contact` WHERE status='1' ORDER BY `id` DESC";
                            $select = $db->select($query);
                            $sl = 1;
                            if ($select){
                                while($row = mysqli_fetch_assoc($select)){
                                    ?>
                                    <tr>
                                        <td><?=$sl?></td>
                                        <td><?=$row['fname'].' '.$row['lname']?></td>
                                        <td><?=$row['email']?></td>
                                        <td><?=$fr->textShorten($row['msg'],50)?></td>
                                        <td><?=$fr->formatedate($row['datetime'])?></td>
                                        <td>
                                            <a onclick="return confirm('Are You Sure To Delete')" href="?delid=<?=$row['id']?>" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i> Delete</a>
                                        </td>
                                    </tr>
                                    <?php
                                    $sl++;
                                }
                            }else{
                                echo "No Data Avaliable";
                            }

                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </div>
    </div>

<?php require_once 'footer.php'?>