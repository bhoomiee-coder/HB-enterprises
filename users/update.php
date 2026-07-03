<?php

include("../includes/auth.php");
include("../includes/permission.php");
requireRole(['Super Admin']);
include("../includes/db.php");

$id=$_POST['id'];
$full_name=$_POST['full_name'];
$username=$_POST['username'];
$email=$_POST['email'];
$phone=$_POST['phone'];
$role=$_POST['role'];
$status=$_POST['status'];

$sql="UPDATE users SET

full_name='$full_name',

username='$username',

email='$email',

phone='$phone',

role='$role',

status='$status'

WHERE id='$id'";

mysqli_query($conn,$sql);

header("Location:index.php");

?>