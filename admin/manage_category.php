<?php
require_once 'header.php';
?>


    <div class="row">
        <div class="col-sm-12">
            <section class="card">
                <header class="card-header">
                    Manage Category
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
                                <th>Catagory Bame</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $query = "SELECT * FROM `tbl_category` ORDER BY `id` DESC";
                            $manage_catagory = $db->select($query);
                            $sl = 1;
                            while($row = mysqli_fetch_assoc($manage_catagory)){
                                ?>
                                <tr>
                                    <td><?=$sl?></td>
                                    <td><?=$row['name']?></td>
                                    <td>
                                        <a href="edit_catagory.php?catid=<?=$row['id']?>" class="btn btn-warning btn-sm"><i class="fa fa-pencil-square-o"></i> Edit</a>
                                        <a onclick="return confirm('Are You Want To Delete ?')" href="delete_cat.php?detid=<?=$row['id']?>" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i> Delete</a>
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