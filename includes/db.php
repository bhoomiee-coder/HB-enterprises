<?php

$host="localhost";
$user="root";
$pass="";
$db="hb_enterprises";

$conn=mysqli_connect($host,$user,$pass,$db);

if(!$conn)
{
    die("Database Connection Failed");
}

?>