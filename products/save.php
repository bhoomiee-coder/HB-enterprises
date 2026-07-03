<?php

include("../includes/auth.php");
include("../includes/db.php");

$product = $_POST['product_name'];
$size = $_POST['size'];
$motor = $_POST['motor'];
$price = $_POST['price'];
$description = $_POST['description'];
$hsn = $_POST['hsn'];


$image = "";

if(isset($_FILES['image']) && $_FILES['image']['name'] != "")
{
    $image = time() . "_" . $_FILES['image']['name'];

    move_uploaded_file(
        $_FILES['image']['tmp_name'],
        "../uploads/products/" . $image
    );
}

$sql = "INSERT INTO products
(product_name,size,motor,description,image,price,hsn)
VALUES
('$product','$size','$motor','$description','$image','$price','$hsn')";

if(mysqli_query($conn,$sql))
{
    header("Location:index.php");
    exit;
}
else
{
    echo mysqli_error($conn);
}
?>