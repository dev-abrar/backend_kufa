<?php 
session_start();
require '../db.php';

$id =$_GET['id'];

$delete = "DELETE FROM social WHERE id=$id";
mysqli_query($db_connect, $delete);

$_SESSION['delete'] = 'DELETE';
header('location:social.php');

?>