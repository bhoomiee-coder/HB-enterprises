<?php

include("../includes/auth.php");
include("../includes/db.php");
include("../includes/header.php");
include("../includes/sidebar.php");

$id = $_GET['id'];

// Invoice Details
$invoice = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT * FROM invoices
WHERE id='$id'
"));

// Invoice Items
$items = mysqli_query($conn,"
SELECT * FROM invoice_items
WHERE invoice_id='$id'
");

?>

<div class="main">

<div class="topbar">

<h3>Edit Invoice</h3>

<div>

<a href="index.php" class="btn btn-secondary">

<i class="fa-solid fa-arrow-left"></i>

Back

</a>

</div>

</div>

<div class="card">

<div class="card-body">

<form
action="update.php"
method="POST"
id="invoiceForm">

<input
type="hidden"
name="id"
value="<?= $invoice['id']; ?>">

<div class="row">

<div class="col-md-4 mb-3">

<label>Invoice No</label>

<input
type="text"
class="form-control"
name="invoice_no"
value="<?= $invoice['invoice_no']; ?>"
readonly>

</div>

<div class="col-md-4 mb-3">

<label>Invoice Date</label>

<input
type="date"
class="form-control"
name="invoice_date"
value="<?= $invoice['invoice_date']; ?>">

</div>

<div class="col-md-4 mb-3">

<label>Buyer Name</label>

<input
type="text"
class="form-control"
name="buyer_name"
value="<?= $invoice['buyer_name']; ?>">

</div>

<div class="col-md-6 mb-3">

<label>Buyer GSTIN</label>

<input
type="text"
class="form-control"
name="buyer_gstin"
value="<?= $invoice['buyer_gstin']; ?>">

</div>

<div class="col-md-6 mb-3">

<label>Buyer State</label>

<input
type="text"
class="form-control"
name="buyer_state"
value="<?= $invoice['buyer_state']; ?>">

</div>

<div class="col-md-12 mb-3">

<label>Buyer Address</label>

<textarea
class="form-control"
rows="3"
name="buyer_address"><?= $invoice['buyer_address']; ?></textarea>

</div>

<hr>

<h5 class="mb-3">

Product Details

</h5>

<table class="table table-bordered">

<thead class="table-dark">

<tr>

<th>Product</th>

<th>HSN</th>

<th>Qty</th>

<th>Unit</th>

<th>Rate</th>

<th>GST%</th>

<th>Amount</th>

</tr>

</thead>

<tbody>
    <?php
while($row=mysqli_fetch_assoc($items))
{
?>

<tr>

<td>

<input
type="hidden"
name="product_id[]"
value="<?= $row['product_id']; ?>">

<?= $row['product_name']; ?>

</td>

<td>

<input
type="text"
class="form-control"
name="hsn[]"
value="<?= $row['hsn']; ?>"
readonly>

</td>

<td>

<input
type="number"
class="form-control qty"
name="qty[]"
value="<?= $row['qty']; ?>">

</td>

<td>

<input
type="text"
class="form-control"
name="unit[]"
value="<?= $row['unit']; ?>"
readonly>

</td>

<td>

<input
type="number"
class="form-control rate"
name="rate[]"
value="<?= $row['rate']; ?>">

</td>

<td>

<input
type="number"
class="form-control gst"
name="gst[]"
value="<?= $row['gst']; ?>">

</td>

<td>

<input
type="number"
class="form-control amount"
name="amount[]"
value="<?= $row['amount']; ?>"
readonly>

</td>

</tr>

<?php
}
?>

</tbody>

</table>

<div class="row mt-4">

<div class="col-md-8">

<label><b>Declaration</b></label>

<textarea
class="form-control"
rows="5"
name="declaration"><?= $invoice['declaration']; ?></textarea>

</div>

<div class="col-md-4">

<table class="table table-bordered">

<tr>

<th>Subtotal</th>

<td>

<input
type="text"
class="form-control"
id="subtotal"
name="subtotal"
value="<?= $invoice['subtotal']; ?>"
readonly>

</td>

</tr>

<tr>

<th>CGST</th>

<td>

<input
type="text"
class="form-control"
id="cgst"
name="cgst"
value="<?= $invoice['cgst']; ?>"
readonly>

</td>

</tr>

<tr>

<th>SGST</th>

<td>

<input
type="text"
class="form-control"
id="sgst"
name="sgst"
value="<?= $invoice['sgst']; ?>"
readonly>

</td>

</tr>

<tr>

<th>Grand Total</th>

<td>

<input
type="text"
class="form-control"
id="grand_total"
name="grand_total"
value="<?= $invoice['grand_total']; ?>"
readonly>

</td>

</tr>

</table>

</div>

</div>

<div class="text-end mt-4">

<button
type="submit"
class="btn btn-success">

<i class="fa-solid fa-floppy-disk"></i>

Update Invoice

</button>

<a
href="index.php"
class="btn btn-secondary ms-2">

<i class="fa-solid fa-arrow-left"></i>

Back

</a>

</div>

</form>

</div>

</div>

</div>

<script src="invoice.js"></script>

<?php include("../includes/footer.php"); ?>