<?php

include("../includes/auth.php");
include("../includes/permission.php");
requireRole(['Super Admin']);

include("../includes/db.php");

$full_name=$_POST['full_name'];
$username=$_POST['username'];
$email=$_POST['email'];
$phone=$_POST['phone'];
$password=password_hash($_POST['password'],PASSWORD_DEFAULT);
$role=$_POST['role'];
$status=$_POST['status'];

$check=mysqli_query($conn,"SELECT * FROM users WHERE username='$username'");

if(mysqli_num_rows($check)>0)
{
die("Username Already Exists");
}

$sql="INSERT INTO users

(full_name,username,email,phone,password,role,status)

VALUES

('$full_name','$username','$email','$phone','$password','$role','$status')";

if(mysqli_query($conn,$sql))
{
header("Location:index.php");
}
else
{
echo mysqli_error($conn);
}

?>