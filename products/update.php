<?php

include("../includes/auth.php");
include("../includes/db.php");

$id = $_POST['id'];

$product = $_POST['product_name'];
$category = $_POST['category'];
$size = $_POST['size'];
$motor = $_POST['motor'];
$price = $_POST['price'];
$description = $_POST['description'];
$hsn = $_POST['hsn'];


$image = "";

if($_FILES['image']['name']!="")
{
    $image = time()."_".$_FILES['image']['name'];
    move_uploaded_file($_FILES['image']['tmp_name'],"../uploads/products/".$image);

    $sql = "UPDATE products SET
    product_name='$product',
    category='$category',
    size='$size',
    motor='$motor',
    price='$price',
    description='$description',
    hsn='$hsn',
   
    image='$image'
    WHERE id='$id'";
}
else
{
    $sql = "UPDATE products SET
    product_name='$product',
    category='$category',
    size='$size',
    motor='$motor',
    price='$price',
    description='$description',
    hsn='$hsn'
    
    WHERE id='$id'";
}

if(mysqli_query($conn,$sql))
{
    header("Location:index.php");
}
else
{
    echo mysqli_error($conn);
}

?>