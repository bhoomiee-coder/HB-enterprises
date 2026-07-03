<?php
include("../includes/auth.php");
include("../includes/header.php");
include("../includes/sidebar.php");
?>

<div class="main">

<div class="card">

<div class="card-header bg-primary text-white">

<h4>Add Product</h4>

</div>

<div class="card-body">

<form action="save.php" method="POST">

<div class="row">

<div class="col-md-6 mb-3">

<label>Product Name</label>

<input type="text" name="product_name" class="form-control" required>

</div>



<div class="col-md-6 mb-3">

<label>Size</label>

<input type="text" name="size" class="form-control">

</div>

<div class="col-md-6 mb-3">

<label>Motor</label>

<input type="text" name="motor" class="form-control">

</div>

<div class="col-md-6 mb-3">

<label>Price</label>

<input type="number" name="price" class="form-control">

</div>

<div class="col-md-6 mb-3">

<form action="save.php" method="POST" enctype="multipart/form-data">

</div>

<div class="col-md-12 mb-3">

<label>Description</label>

<textarea name="description" class="form-control"></textarea>

</div>
<div class="col-md-6 mb-3">
    <label>HSN Code</label>
    <input type="text" name="hsn" class="form-control" placeholder="Enter HSN Code">
</div>


<div class="col-md-6 mb-3">

<label>Product Image</label>

<input
type="file"
name="image"
class="form-control"
accept="image/*">

</div>
</div>

<div class="mt-4 me-3 = margin-end text-end">

    <button type="submit" class="btn btn-success me-3">
        <i class="fa-solid fa-floppy-disk"></i> Save Product
    </button>

    <a href="index.php" class="btn btn-secondary">
        <i class="fa-solid fa-arrow-left"></i> Back
    </a>

</div>


</form>

</div>

</div>

</div>

<?php include("../includes/footer.php"); ?>