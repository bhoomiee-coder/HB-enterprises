<?php
include("../includes/auth.php");
include("../includes/permission.php");
requireRole(['Super Admin']);

include("../includes/header.php");
include("../includes/sidebar.php");
?>

<div class="main">

<div class="topbar">
    <h3>Add User</h3>
</div>

<div class="card">
<div class="card-body">

<form action="save.php" method="POST">

<div class="row">

<div class="col-md-6 mb-3">
<label>Full Name</label>
<input type="text" name="full_name" class="form-control" required>
</div>

<div class="col-md-6 mb-3">
<label>Username</label>
<input type="text" name="username" class="form-control" required>
</div>

<div class="col-md-6 mb-3">
<label>Email</label>
<input type="email" name="email" class="form-control">
</div>

<div class="col-md-6 mb-3">
<label>Phone</label>
<input type="text" name="phone" class="form-control">
</div>

<div class="col-md-6 mb-3">
<label>Password</label>
<input type="password" name="password" class="form-control" required>
</div>

<div class="col-md-6 mb-3">
<label>Role</label>

<select name="role" class="form-select">

<option>Super Admin</option>
<option>Admin</option>
<option>User</option>

</select>

</div>

<div class="col-md-6 mb-3">

<label>Status</label>

<select name="status" class="form-select">

<option>Active</option>
<option>Inactive</option>

</select>

</div>

</div>

<button class="btn btn-success">

<i class="fa fa-save"></i>

Save User

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