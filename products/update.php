<?php

include("../includes/auth.php");
include("../includes/db.php");

$id = $_POST['id'];
$product = $_POST['product_name'];
$size = $_POST['size'];
$motor = $_POST['motor'];
$price = $_POST['price'];
$description = $_POST['description'];

// Old image nikal lo
$get = mysqli_query($conn,"SELECT image FROM products WHERE id='$id'");
$row = mysqli_fetch_assoc($get);

$image = $row['image'];

// Agar nayi image upload hui hai
if($_FILES['image']['name']!="")
{
    // Purani image delete karo
    if($image!="" && file_exists("../uploads/products/".$image))
    {
        unlink("../uploads/products/".$image);
    }

    // New image upload
    $image = time()."_".$_FILES['image']['name'];

    move_uploaded_file(
        $_FILES['image']['tmp_name'],
        "../uploads/products/".$image
    );
}

$sql = "UPDATE products SET

product_name='$product',
size='$size',
motor='$motor',
price='$price',
description='$description',
image='$image'

WHERE id='$id'";

if(mysqli_query($conn,$sql))
{
    header("Location:index.php?updated=1");
    exit;
}
else
{
    echo mysqli_error($conn);
}

?>