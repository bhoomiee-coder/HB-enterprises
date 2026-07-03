
<?php
include("../includes/auth.php");
include("../includes/db.php");
include("../includes/header.php");
include("../includes/sidebar.php");

$result = mysqli_query($conn,"SELECT * FROM products ORDER BY id ASC");
?>

<div class="main">

<div class="topbar">
    <h3>Product Management</h3>

    <a href="add.php" class="btn btn-primary">
        <i class="fa-solid fa-plus"></i> Add Product
    </a>
</div>

<div class="card">
<div class="card-body">

<table class="table table-bordered table-hover" id="productTable">

<thead class="table-dark">

<tr>

<tr>

<th>ID</th>
<th>Product</th>
<th>Description</th>
<th>Size</th>
<th>Motor</th>
<th>HSN</th>

<th>Price</th>
<th>Image</th>
<th>Action</th>

</tr>
</tr>

</thead>

<tbody>

<?php while($row=mysqli_fetch_assoc($result)){ ?>

<tr>

<td><?= $row['id']; ?></td>
<td><?= $row['product_name']; ?></td>
<td><?= $row['description']; ?></td>
<td><?= $row['size']; ?></td>
<td><?= $row['motor']; ?></td>
<td><?= $row['hsn']; ?></td>

<td>₹<?= number_format($row['price'],2); ?></td>


<td>

<?php
if($row['image']!="")
{
?>

<img
src="../uploads/products/<?php echo $row['image'];?>"
width="70"
height="70"
style="border-radius:8px;object-fit:cover;">

<?php
}
else
{
?>

<img
src="../assets/images/no-image.png"
width="70">

<?php
}
?>

</td>

<td>

<div class="d-flex justify-content-center gap-2">

    <a href="edit.php?id=<?= $row['id']; ?>" class="btn btn-warning btn-sm">
        <i class="fa-solid fa-pen"></i>
    </a>

    <a href="delete.php?id=<?= $row['id']; ?>"
       class="btn btn-danger btn-sm"
       onclick="return confirm('Are you sure you want to delete this product?');">
        <i class="fa-solid fa-trash"></i>
    </a>

</div>

</td>





</tr>

<?php } ?>

</tbody>

</table>

</div>
</div>

</div>

<?php include("../includes/footer.php"); ?>