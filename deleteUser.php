<?php

    include_once "connection.php";
    
    $p_id=$_POST['record'];
    $query="DELETE FROM users where id='$p_id'";

    $data=mysqli_query($con,$query);

    if($data){
        echo"User Deleted";
    }
    else{
        echo"Not able to delete";
    }
    
?>