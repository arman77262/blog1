<?php
require_once 'header.php';

if (isset($_GET['delslider'])){
    $id = $_GET['delslider'];
    $query = "DELETE FROM tbl_slider WHERE  id = '$id'";
    $delete = $db->delete($query);
}

?>


    <div class="row">
        <div class="col-sm-12">
            <section class="card">
                <header class="card-header">
                    Manage Slider
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
                                <th>Sl No</th>
                                <th>Image</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $query = "SELECT * FROM tbl_slider";
                            $manage_catagory = $db->select($query);
                            $sl = 1;
                            while($row = mysqli_fetch_assoc($manage_catagory)){
                                ?>
                                <tr>
                                    <td><?=$sl?></td>
                                    <td><img src="<?=$row['image']?>" style="width: 120px;" alt=""></td>
                                    <td><?=$row['status']?></td>
                                    <td>

                                        <a href="edit_slider.php?slider_edit=<?=$row['id']?>" class="btn btn-warning btn-sm"><i class="fa fa-pencil-square-o"></i> Edit</a>
                                        <?php
                                            if ($row['id'] == 1){
                                                ?>

                                                <?php
                                            }
                                        ?>
                                        <a onclick="return confirm('Are You Want To Delete ?')" href="?delslider=<?=$row['id']?>" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i> Delete</a>

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



<?php require_once 'footer.php'?>