<?php
require_once 'header.php';

//delete user

if (isset($_GET['deluser'])){
    $deluser = $_GET['deluser'];
    $query = "DELETE FROM tbl_user WHERE id='$deluser'";
    $deleteuser = $db->delete($query);
}
?>


    <div class="row">
        <div class="col-sm-12">
            <section class="card">
                <header class="card-header">
                    <b>User List</b>
                    <span class="tools pull-right">
                        <a href="javascript:;" class="fa fa-chevron-down"></a>
                        <a href="javascript:;" class="fa fa-times"></a>
                    </span>
                </header>
                <div class="card-body">
                    <div class="adv-table">
                        <table  class="display table table-bordered table-striped" id="dynamic-table">
                            <thead>
                            <tr>
                                <th>Serial No.</th>
                                <th>Name</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Details</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $query = "SELECT * FROM `tbl_user` ORDER BY `id` DESC";
                            $manage_catagory = $db->select($query);
                            $sl = 1;
                            while($row = mysqli_fetch_assoc($manage_catagory)){
                                ?>
                                <tr>
                                    <td><?=$sl?></td>
                                    <td><?=$row['name']?></td>
                                    <td><?=$row['username']?></td>
                                    <td><?=$row['email']?></td>
                                    <td>
                                        <?php
                                            if ($row['role'] == 1){
                                                echo 'Admin';
                                            }elseif ($row['role'] == 2){
                                                echo 'Author';
                                            }elseif ($row['role'] == 3){
                                                echo 'Editor';
                                            }
                                        ?>
                                    </td>
                                    <td><?=$fr->textShorten($row['details'],30)?></td>
                                    <td>
                                        <a class="btn btn-success btn-sm" data-toggle="modal" href="#userid-<?=$row['id']?>"><i class="fa fa-eye"></i> View</a>
                                        <?php
                                            if (Session::get('userRole')==1){
                                                ?>
                                                <a onclick="return confirm('Are You Want To Delete ?')" href="?deluser=<?=$row['id']?>" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i>Delete</a>
                                                <?php
                                            }
                                        ?>
                                    </td>
                                </tr>
                                <?php
                                $sl++;
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <!-- Modal -->
<?php
    $query = "SELECT * FROM tbl_user";
    $select = $db->select($query);
    if ($select){
        while ($row = mysqli_fetch_assoc($select)){
            ?>
            <div class="modal fade" id="userid-<?=$row['id']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="myModal2">View User Details</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <table class="table table-bordered">
                                <tr>
                                    <td>Name</td>
                                    <td><?=$row['name']?></td>
                                </tr>
                                <tr>
                                    <td>Username</td>
                                    <td><?=$row['username']?></td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td><?=$row['email']?></td>
                                </tr>
                                <tr>
                                    <td>Details</td>
                                    <td><?=$row['details']?></td>
                                </tr>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
    }
?>

    <!-- modal -->

<?php require_once 'footer.php'?>