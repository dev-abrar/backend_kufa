<?php  
session_start();
require '../db.php';

$logo = $_FILES['logo'];
$explode = explode('.', $logo['name']);
$extn = end($explode);
$allowed_logo = array('png', 'jpg', 'jpeg');
$name = $logo['name'];


if(in_array($extn, $allowed_logo)){
    if($logo['size'] <= 10000000){
        $insert = "INSERT INTO logos (logo) VALUES('$name')";
        mysqli_query($db_connect, $insert);
        $last_id = mysqli_insert_id($db_connect);
        $file_name = $last_id.'.'.$extn;
        $new_locate = '../upload/logo/'.$file_name;
        move_uploaded_file($logo['tmp_name'], $new_locate);
        $update = "UPDATE logos SET logo='$file_name' WHERE id=$last_id";
        mysqli_query($db_connect, $update);
        header('location:logo.php');
    }
    else{
        $_SESSION['extn'] = 'Beshi boro';
        header('location:logo.php');
    }
}
else{
    $_SESSION['extn'] = 'Extn mile nai';
    header('location:logo.php');
}
?>