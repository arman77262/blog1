<?php
require_once '../config/config.php';
require_once '../lib/Database.php';
$db = new Database();
if ($_GET['detid']){
    $delid = $_GET['detid'];
    $query = "DELETE FROM `tbl_category` WHERE `id`='$delid'";
    $result = $db->delete($query);
    if ($result){
        echo "<script>window.location='manage_category.php'</script>";
    }
}