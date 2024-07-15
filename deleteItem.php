<?php

    include_once "connection.php";
    
    $p_id=$_POST['record'];
    $query="DELETE FROM fruits where id='$p_id'";

    $data=mysqli_query($con,$query);

    if($data){
        echo"Product Item Deleted";
    }
    else{
        echo"Not able to delete";
    }
    
?>