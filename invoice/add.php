<?php
include("../includes/auth.php");
include("../includes/db.php");
include("../includes/header.php");
include("../includes/sidebar.php");

$company=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM company_settings LIMIT 1"));

$customer=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM customers LIMIT 1"));

$next=mysqli_fetch_assoc(mysqli_query($conn,"SELECT MAX(id) as id FROM invoices"));

$invoice_no="HB".str_pad($next['id']+1,6,"0",STR_PAD_LEFT);
?>

<link rel="stylesheet" href="invoice.css">

<div class="main">

<div class="toolbar">

<a href="index.php" class="btn btn-secondary">
<i class="fa-solid fa-arrow-left"></i>
Back
</a>

<button form="invoiceForm" class="btn btn-success">
<i class="fa-solid fa-floppy-disk"></i>
Save Invoice
</button>

<button type="button" class="btn btn-primary" onclick="window.print()">
<i class="fa-solid fa-print"></i>
Print
</button>

</div>

<form id="invoiceForm" action="save.php" method="POST">

<div class="invoice-container">

<div class="invoice-title">

TAX INVOICE

</div>

<table class="inv-table">

<tr>

<td width="55%">

<div class="company-name">

<input
type="text"
name="company_name"
value="<?= $company['company_name'];?>">

</div>

GSTIN/UIN :

<input
type="text"
name="company_gstin"
value="<?= $company['gstin'];?>">

<br><br>

State Name :

<input
type="text"
name="company_state"
value="<?= $company['state_name'];?>">

Code :

<input
type="text"
name="company_code"
value="<?= $company['state_code'];?>">

<br><br>

<textarea
name="company_address"><?= $company['address'];?></textarea>

</td>

<td width="45%">

<table class="inv-table invoice-details">

<tr>

<td>Invoice No.</td>

<td>

<input
type="text"
name="invoice_no"
value="<?= $invoice_no;?>">

</td>

</tr>

<tr>

<td>Date</td>

<td>

<input
type="date"
name="invoice_date"
value="<?= date('Y-m-d');?>">

</td>

</tr>

<tr>

<td>Delivery Note</td>

<td>

<input
type="text"
name="delivery_note">

</td>

</tr>

<tr>

<td>Supplier Reference</td>

<td>

<input
type="text"
name="supplier_reference">

</td>

</tr>

<tr>

<td>Buyer's Order No.</td>

<td>

<input
type="text"
name="buyer_order_no">

</td>

</tr>

<tr>

<td>Dispatch Doc No.</td>

<td>

<input
type="text"
name="dispatch_doc">

</td>

</tr>

<tr>

<td>Dispatch Through</td>

<td>

<input
type="text"
name="dispatch_through">

</td>

</tr>

<tr>

<td>Destination</td>

<td>

<input
type="text"
name="destination">

</td>

</tr>

</table>

</td>

</tr>

<tr>

<td>

<b>Consignee (Ship To)</b>

<br><br>

Company

<input
type="text"
name="ship_company"
value="<?= $customer['company_name'];?>">

GSTIN/UIN

<input
type="text"
name="ship_gstin"
value="<?= $customer['gstin'];?>">

State

<input
type="text"
name="ship_state"
value="<?= $customer['state_name'];?>">

<textarea
name="ship_address"><?= $customer['address'];?></textarea>

</td>

<td>

<b>Buyer (Bill To)</b>

<br><br>

Company

<input
type="text"
name="buyer_name"
value="<?= $customer['company_name'];?>">

GSTIN/UIN

<input
type="text"
name="buyer_gstin"
value="<?= $customer['gstin'];?>">

State

<input
type="text"
name="buyer_state"
value="<?= $customer['state_name'];?>">

<textarea
name="buyer_address"><?= $customer['address'];?></textarea>

</td>

</tr>

</table>
<table class="inv-table product-table">

<thead>

<tr>

<th width="5%">Sr</th>

<th width="30%">Description of Goods</th>

<th width="12%">HSN/SAC</th>

<th width="8%">GST %</th>

<th width="8%">Qty</th>

<th width="8%">Unit</th>

<th width="12%">Rate</th>

<th width="17%">Amount</th>

<th width="5%"></th>

</tr>

</thead>

<tbody id="productBody">

<tr>

<td>1</td>

<td>

<select name="product_id[]" class="product form-control">

<option value="">Select Product</option>

<?php

$pro=mysqli_query($conn,"SELECT * FROM products ORDER BY product_name");

while($p=mysqli_fetch_assoc($pro))
{

?>

<option

value="<?= $p['id'];?>"

data-price="<?= $p['price'];?>"

data-hsn="<?= $p['hsn'];?>"

data-unit="<?= $p['unit'];?>"

>

<?= $p['product_name'];?>

</option>

<?php } ?>

</select>

</td>

<td>

<input
type="text"
name="hsn[]"
class="hsn">

</td>

<td>

<input
type="number"
name="gst[]"
class="gst"
value="18">

</td>

<td>

<input
type="number"
name="qty[]"
class="qty"
value="1">

</td>

<td>

<input
type="text"
name="unit[]"
class="unit">

</td>

<td>

<input
type="number"
name="rate[]"
class="rate">

</td>

<td>

<input
type="number"
name="amount[]"
class="amount"
readonly>

</td>

<td>

<button
type="button"
class="btn btn-success addRow">

+

</button>

</td>

</tr>

</tbody>

</table>
<table class="inv-table">

<tr>

<td width="60%">

<b>Amount Chargeable (in words)</b>

<textarea

id="amount_words"

name="amount_words"

readonly></textarea>

</td>

<td width="40%">

<table class="total-table">

<tr>

<td class="total-label">

Sub Total

</td>

<td>

<input
id="subtotal"
name="subtotal"
readonly>

</td>

</tr>

<tr>

<td>

CGST 9%

</td>

<td>

<input
id="cgst"
name="cgst"
readonly>

</td>

</tr>

<tr>

<td>

SGST 9%

</td>

<td>

<input
id="sgst"
name="sgst"
readonly>

</td>

</tr>

<tr>

<td>

Round Off

</td>

<td>

<input
id="roundoff"
value="0.00"
readonly>

</td>

</tr>

<tr>

<td>

<b>Grand Total</b>

</td>

<td>

<input
id="grandtotal"
name="grand_total"
readonly>

</td>

</tr>

</table>

</td>

</tr>

</table>
<table class="inv-table">

<tr>

<td width="70%">

<b>Declaration</b>

<br><br>

<textarea

name="declaration"

rows="6">

We declare that this invoice shows the actual price of the goods described and that all particulars are true and correct.

</textarea>

</td>

<td width="30%">

<div class="sign-box">

For

<b>HB ENTERPRISES</b>

<div class="signature">

Authorized Signatory

</div>

</div>

</td>

</tr>

</table>

</div>

</form>
<script src="invoice.js"></script>
</body>

<?php include("../includes/footer.php"); ?>