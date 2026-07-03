
<?php

include("../includes/auth.php");
include("../includes/permission.php");

requireRole(['Super Admin']);

include("../includes/db.php");
include("../includes/header.php");
include("../includes/sidebar.php");

?>
<div class="main">

<div class="topbar">

<h3>User Management</h3>

<a href="add.php" class="btn btn-primary">

<i class="fa-solid fa-plus"></i>

Add User

</a>

</div>

<div class="card">

<div class="card">

<div class="card-body">

<table id="userTable" class="table table-bordered table-hover">

<thead class="table-dark">

<tr>

<th>ID</th>
<th>Name</th>
<th>Username</th>
<th>Email</th>
<th>Phone</th>
<th>Role</th>
<th>Status</th>
<th>Action</th>

</tr>

</thead>

<tbody>

<?php

$sql="SELECT * FROM users ORDER BY id DESC";

$result=mysqli_query($conn,$sql);

while($row=mysqli_fetch_assoc($result))
{

?>

<tr>

<td><?php echo $row['id']; ?></td>

<td><?php echo $row['full_name']; ?></td>

<td><?php echo $row['username']; ?></td>

<td><?php echo $row['email']; ?></td>

<td><?php echo $row['phone']; ?></td>

<td>

<span class="badge bg-primary">

<?php echo $row['role']; ?>

</span>

</td>

<td>

<?php

if($row['status']=="Active")
{
?>

<span class="badge bg-success">

Active

</span>

<?php
}
else
{
?>

<span class="badge bg-danger">

Inactive

</span>

<?php
}

?>

</td>

<td>

<a
href="edit.php?id=<?php echo $row['id'];?>"
class="btn btn-warning btn-sm">

<i class="fa-solid fa-pen"></i>

</a>

<a
href="javascript:void(0)"
onclick="deleteUser(<?php echo $row['id'];?>)"
class="btn btn-danger btn-sm">

<i class="fa-solid fa-trash"></i>

</a>
</td>

</tr>

<?php

}

?>

</tbody>

</table>

</div>

</div>

</div>

</div>

</div>

<?php

include("../includes/footer.php");

?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

function deleteUser(id){

Swal.fire({

title:'Delete User?',

text:'You cannot undo this.',

icon:'warning',

showCancelButton:true,

confirmButtonColor:'#d33',

confirmButtonText:'Delete'

}).then((result)=>{

if(result.isConfirmed){

window.location="delete.php?id="+id;

}

});

}

</script>