<?php

include("../includes/auth.php");
include("../includes/permission.php");
requireRole(['Super Admin']);
include("../includes/db.php");

$id=$_GET['id'];

mysqli_query($conn,"DELETE FROM users WHERE id='$id'");

header("Location:index.php");

?>