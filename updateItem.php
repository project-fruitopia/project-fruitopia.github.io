<?php
    include_once "connection.php";

    $product_id=$_POST['product_id'];
    $p_code= $_POST['p_code'];
    $p_name= $_POST['p_name'];
    $p_desc= $_POST['p_desc'];
    $p_price= $_POST['p_price'];
    $p_qty= $_POST['p_qty'];

    if( isset($_FILES['newImage']) ){
        
        $location="/images/";
        $img = $_FILES['newImage']['name'];
        $tmp = $_FILES['newImage']['tmp_name'];
        $dir = '/uploads/';
        $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
        $valid_extensions = array('jpeg', 'jpg', 'png', 'gif','webp');
        $image =rand(1000,1000000).".".$ext;
        $final_image=$location. $image;
        if (in_array($ext, $valid_extensions)) {
            $path = UPLOAD_PATH . $image;
            move_uploaded_file($tmp, $dir.$image);
        }
    }else{
        $final_image=$_POST['existingImage'];
    }
    $updateItem = mysqli_query($con,"UPDATE fruits SET 
        code='$p_code',
        name='$p_name', 
        description='$p_desc', 
        retailprice=$p_price,
        quantity=$p_qty,
        img='$final_image' 
        WHERE id=$product_id");


    if($updateItem)
    {
        echo "true";
    }

?>