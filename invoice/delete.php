<?php

include("../includes/auth.php");
include("../includes/db.php");

if(isset($_GET['id']))
{

    $id = $_GET['id'];

    // Check Invoice Exists
    $check = mysqli_query($conn,"SELECT * FROM invoices WHERE id='$id'");

    if(mysqli_num_rows($check)>0)
    {

        // Delete Invoice
        mysqli_query($conn,"DELETE FROM invoices WHERE id='$id'");

        header("Location:index.php?msg=deleted");
        exit();

    }
    else
    {

        echo "Invoice Not Found.";

    }

}
else
{

    header("Location:index.php");
    exit();

}

?>