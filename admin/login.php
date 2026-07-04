<?php
session_start();
include("../includes/db.php");

if(isset($_SESSION['admin']))
{
    header("Location: dashboard.php");
    exit;
}

$error="";

if(isset($_POST['login']))
{

    $username=$_POST['username'];
    $password=$_POST['password'];

    $sql="SELECT * FROM users
WHERE username='$username'
AND status='Active'";

$result=mysqli_query($conn,$sql);

if(mysqli_num_rows($result)>0)
{
$user=mysqli_fetch_assoc($result);

if(password_verify($password,$user['password']))
{

$_SESSION['user_id']=$user['id'];
$_SESSION['name']=$user['full_name'];
$_SESSION['username']=$user['username'];
$_SESSION['role']=$user['role'];

header("Location:dashboard.php");
exit;

}
else
{
$error="Invalid Password";
}

}
else
{
$error="User Not Found";
}
    $result=mysqli_query($conn,$sql);

    if(mysqli_num_rows($result)>0)
    {
       $user=mysqli_fetch_assoc($result);

$_SESSION['user_id']=$user['id'];
$_SESSION['username']=$user['username'];
$_SESSION['name']=$user['full_name'];
$_SESSION['role']=$user['role'];
        header("Location: dashboard.php");
        exit;
    }
    else
    {
        $error="Invalid Username or Password";
    }

}

?>

<!DOCTYPE html>
<html>

<head>

<meta charset="UTF-8">

<title>HB ENTERPRISES ERP</title>

<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Segoe UI',sans-serif;
}

body{
    height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    background:linear-gradient(135deg,#0f172a,#1e3a8a,#2563eb);
    overflow:hidden;
}

.login-box{
    width:420px;
    background:rgba(255,255,255,.95);
    backdrop-filter:blur(12px);
    padding:40px;
    border-radius:20px;
    box-shadow:0 25px 60px rgba(0,0,0,.35);
    animation:fadeIn .7s ease;
}

.logo{
    display:flex;
    justify-content:center;
    margin-bottom:20px;
}

.logo img{
    width:110px;
    height:110px;
    object-fit:contain;
}

h2{
    text-align:center;
    font-weight:700;
    color:#0f172a;
    margin-bottom:5px;
}

p{
    text-align:center;
    color:#64748b;
    margin-bottom:30px;
}

.form-label{
    font-weight:600;
}

.form-control{
    height:48px;
    border-radius:10px;
}

.form-control:focus{
    border-color:#2563eb;
    box-shadow:0 0 8px rgba(37,99,235,.25);
}

.input-group button{
    border-radius:0 10px 10px 0;
}

.btn-login{
    width:100%;
    height:48px;
    border:none;
    border-radius:10px;
    background:#2563eb;
    color:#fff;
    font-size:17px;
    font-weight:600;
    transition:.3s;
}

.btn-login:hover{
    background:#1d4ed8;
    transform:translateY(-2px);
}

.alert{
    border-radius:10px;
}

@keyframes fadeIn{

from{
opacity:0;
transform:translateY(20px);
}

to{
opacity:1;
transform:translateY(0);
}

}
</style>

</head>

<body>

<div class="login-box">

    <div class="logo">
        <img src="../uploads/products/images/logo.png" alt="HB Enterprises Logo">
    </div>

    <h2>HB ENTERPRISES</h2>
    <p>ERP Login</p>

    <?php if($error!=""){ ?>
        <div class="alert alert-danger">
            <?php echo $error; ?>
        </div>
    <?php } ?>

    <form method="post">

        <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text" name="username" class="form-control" placeholder="Enter Username" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Password</label>

            <div class="input-group">
                <input type="password" id="password" name="password" class="form-control" placeholder="Enter Password" required>

                <button class="btn btn-outline-secondary" type="button" onclick="showPassword()">
                    <i class="fa-solid fa-eye"></i>
                </button>
            </div>
        </div>

        <button class="btn btn-login" name="login">
            <i class="fa-solid fa-right-to-bracket"></i> Login
        </button>

    </form>

</div>

<?php

if($error!="")
{
?>

<div class="alert alert-danger">

<?php echo $error; ?>

</div>

<?php
}
?>



</div>

</div>


<script>

function showPassword(){

    let password=document.getElementById("password");
    let icon=document.querySelector(".input-group button i");

    if(password.type==="password"){
        password.type="text";
        icon.classList.remove("fa-eye");
        icon.classList.add("fa-eye-slash");
    }else{
        password.type="password";
        icon.classList.remove("fa-eye-slash");
        icon.classList.add("fa-eye");
    }

}

</script>

</body>

</html>