<?php
    include_once "connection.php";
    
    if(isset($_POST['upload']))
    {
        $productcode = $_POST['p_code'];
        $productname = $_POST['p_name'];
        $desc= $_POST['p_desc'];
        $price = $_POST['p_price'];
        $qty = $_POST['p_qty'];    
        $name = $_FILES['file']['name'];
        $temp = $_FILES['file']['tmp_name'];
    
        $location="./uploads/";
        $image=$location.$name;

        $target_dir="./uploads/";
        $finalImage=$target_dir.$name;

        move_uploaded_file($temp,$finalImage);

         $insert = mysqli_query($con,"INSERT INTO fruits
         (code,name,img,retailprice,quantity,description) 
         VALUES ('$productcode','$productname','$image',$price,$qty,'$desc')");
 
         if(!$insert)
         {
             echo mysqli_error($con);
         }
         else
         {
             echo "Records added successfully.";
         }
     
    }
        
?>