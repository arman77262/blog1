<?php
require_once '../config/config.php';
require_once '../lib/Database.php';
$db = new Database();
if (isset($_GET['delpage'])){
    $id = $_GET['delpage'];
    $query = "DELETE FROM `tbl_page` WHERE `id`='$id'";
    $result = $db->delete($query);
    if ($result){
        echo "<script>alert('Page Delete Successfully')</script>";
        echo "<script>window.location='index.php'</script>";
    }else{
        echo "<script>alert('Page Not Delete')</script>";
        echo "<script>window.location='index.php'</script>";
    }
}