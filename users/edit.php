<?php
include("../includes/auth.php");
include("../includes/permission.php");
requireRole(['Super Admin']);
include("../includes/db.php");

$id=$_GET['id'];

$sql="SELECT * FROM users WHERE id='$id'";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);

include("../includes/header.php");
include("../includes/sidebar.php");
?>

<div class="container mt-4">

<div class="card shadow">

<div class="card-header bg-primary text-white">
<h4>Edit User</h4>
</div>

<div class="card-body">

<form action="update.php" method="POST">

<input type="hidden" name="id" value="<?php echo $row['id'];?>">

<div class="row">

<div class="col-md-6 mb-3">
<label>Full Name</label>
<input
type="text"
name="full_name"
class="form-control"
value="<?php echo $row['full_name'];?>"
required>
</div>

<div class="col-md-6 mb-3">
<label>Username</label>
<input
type="text"
name="username"
class="form-control"
value="<?php echo $row['username'];?>"
required>
</div>

<div class="col-md-6 mb-3">
<label>Email</label>
<input
type="email"
name="email"
class="form-control"
value="<?php echo $row['email'];?>">
</div>

<div class="col-md-6 mb-3">
<label>Phone</label>
<input
type="text"
name="phone"
class="form-control"
value="<?php echo $row['phone'];?>">
</div>

<div class="col-md-6 mb-3">

<label>Role</label>

<select
name="role"
class="form-select">

<option
<?php if($row['role']=="Super Admin") echo "selected"; ?>>
Super Admin
</option>

<option
<?php if($row['role']=="Admin") echo "selected"; ?>>
Admin
</option>

<option
<?php if($row['role']=="User") echo "selected"; ?>>
User
</option>

</select>

</div>

<div class="col-md-6 mb-3">

<label>Status</label>

<select
name="status"
class="form-select">

<option
<?php if($row['status']=="Active") echo "selected"; ?>>
Active
</option>

<option
<?php if($row['status']=="Inactive") echo "selected"; ?>>
Inactive
</option>

</select>

</div>

</div>

<button class="btn btn-success">

Update User

</button>

<a href="index.php" class="btn btn-secondary">

Back

</a>

</form>

</div>

</div>

</div>

<?php
include("../includes/footer.php");
?>