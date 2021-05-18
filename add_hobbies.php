<?php
include"config.php";
if(isset($_POST['add']) && !empty($_POST['add'])){
    //echo "data-received";
    $hobby=$_POST['add'];
    $sql="INSERT INTO hobbies(title) VALUES('$hobby') ";
    $insert_query=$con->query($sql);
    if (!$insert_query) {
        die("Query FAILED " . $con->error);
    }
}
?>