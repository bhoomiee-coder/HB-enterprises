<?php
include("../includes/auth.php");
include("../includes/db.php");
include("../includes/header.php");
include("../includes/sidebar.php");

$id = $_GET['id'];

$result = mysqli_query($conn,"SELECT * FROM products WHERE id='$id'");
$row = mysqli_fetch_assoc($result);
?>

<div class="main">

    <div class="topbar">
        <h3>Edit Product</h3>
    </div>

    <div class="card shadow">

        <div class="card-body">

            <form action="update.php" method="POST" enctype="multipart/form-data">

                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Product Name</label>
                        <input type="text"
                               name="product_name"
                               class="form-control"
                               value="<?php echo $row['product_name']; ?>"
                               required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Size</label>
                        <input type="text"
                               name="size"
                               class="form-control"
                               value="<?php echo $row['size']; ?>">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Motor</label>
                        <input type="text"
                               name="motor"
                               class="form-control"
                               value="<?php echo $row['motor']; ?>">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Price</label>
                        <input type="number"
                               name="price"
                               class="form-control"
                               value="<?php echo $row['price']; ?>">
                    </div>

                    <div class="col-md-12 mb-3">
                        <label class="form-label">Description</label>

                        <textarea
                            name="description"
                            class="form-control"
                            rows="4"><?php echo $row['description']; ?></textarea>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label">Current Image</label>
                        <br>

                        <?php
                        if(!empty($row['image']) && file_exists("../uploads/products/".$row['image']))
                        {
                        ?>

                            <img src="../uploads/products/<?php echo $row['image']; ?>"
                                 width="150"
                                 height="150"
                                 style="object-fit:cover;border-radius:10px;border:1px solid #ddd;">

                        <?php
                        }
                        else
                        {
                        ?>

                            <img src="../assets/images/no-image.png"
                                 width="150"
                                 height="150"
                                 style="object-fit:cover;border-radius:10px;border:1px solid #ddd;">

                        <?php
                        }
                        ?>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label">Change Image</label>

                        <input
                            type="file"
                            name="image"
                            class="form-control"
                            accept="image/*">

                    </div>

                </div>

                <div class="d-flex justify-content-end gap-3 mt-4 mb-4">

                    <button type="submit" class="btn btn-success">

                        <i class="fa-solid fa-floppy-disk"></i>

                        Update Product

                    </button>

                    <a href="index.php" class="btn btn-secondary">

                        <i class="fa-solid fa-arrow-left"></i>

                        Back

                    </a>

                </div>

            </form>

        </div>

    </div>

</div>

