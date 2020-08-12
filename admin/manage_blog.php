<?php
require_once 'header.php';
?>


    <div class="row">
        <div class="col-sm-12">
            <section class="card">
                <header class="card-header">
                    Manage Post
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
                                <th>Catagory Name</th>
                                <th>Title</th>
                                <th>Tags</th>
                                <th>Author</th>
                                <th width="200px">Body</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $query = "SELECT tbl_post.* , tbl_category.name FROM tbl_post INNER JOIN 
tbl_category ON tbl_post.cat = tbl_category.id";
                            $manage_catagory = $db->select($query);
                            $sl = 1;
                            while($row = mysqli_fetch_assoc($manage_catagory)){
                                ?>
                                <tr>
                                    <td><?=$sl?></td>
                                    <td><?=$row['name']?></td>
                                    <td><?=$row['title']?></td>
                                    <td><?=$row['tags']?></td>
                                    <td><?=$row['author']?></td>
                                    <td><?=$fr->textShorten($row['body'], 60)?></td>
                                    <td><img src="<?=$row['image']?>" style="width: 120px;" alt=""></td>
                                    <td>
                                        <a class="btn btn-success btn-sm" data-toggle="modal" href="#userid-<?=$row['id']?>"><i class="fa fa-eye"></i> View</a>
                                        <?php
                                            if (Session::get('userid')==$row['userid'] || Session::get('userid')==1){
                                                ?>
                                                <a href="edit_blog.php?post_editid=<?=$row['id']?>" class="btn btn-warning btn-sm"><i class="fa fa-pencil-square-o"></i> Edit</a>
                                                <a onclick="return confirm('Are You Want To Delete ?')" href="delete_blog.php?detid=<?=$row['id']?>" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i> Delete</a>
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
$query = "SELECT tbl_post.* , tbl_category.name FROM tbl_post INNER JOIN 
tbl_category ON tbl_post.cat = tbl_category.id";
$select = $db->select($query);
if ($select){
    while ($row = mysqli_fetch_assoc($select)){
        ?>
        <div class="modal fade" id="userid-<?=$row['id']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModal2">Post Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-bordered">
                            <tr>
                                <td>Category Name</td>
                                <td><?=$row['name']?></td>
                            </tr>
                            <tr>
                                <td>Title</td>
                                <td><?=$row['title']?></td>
                            </tr>
                            <tr>
                                <td>Tags</td>
                                <td><?=$row['tags']?></td>
                            </tr>
                            <tr>
                                <td>Author</td>
                                <td><?=$row['author']?></td>
                            </tr>
                            <tr>
                                <td>Image</td>
                                <td><img class="img-thumbnail" src="<?=$row['image']?>" style="width: 120px;" alt=""></td>
                            </tr>
                            <tr>
                                <td>Content</td>
                                <td class="text-justify"><p><?=$row['body']?></p></td>
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