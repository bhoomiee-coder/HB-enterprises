<?php

include("../includes/auth.php");
include("../includes/db.php");

$id = $_GET['id'];

// Product Details
$result = mysqli_query($conn, "SELECT * FROM products WHERE id='$id'");
$row = mysqli_fetch_assoc($result);

// Delete Image
if($row['image'] != "")
{
    $imagePath = "../uploads/products/" . $row['image'];

    if(file_exists($imagePath))
    {
        unlink($imagePath);
    }
}

// Delete Product
mysqli_query($conn, "DELETE FROM products WHERE id='$id'");

header("Location:index.php");
exit();

?>