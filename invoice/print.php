<?php

include("../includes/auth.php");
include("../includes/db.php");

$id = $_GET['id'];

$invoice = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT * FROM invoices
WHERE id='$id'
"));

$items = mysqli_query($conn,"
SELECT * FROM invoice_items
WHERE invoice_id='$id'
");

?>

<!DOCTYPE html>

<html>

<head>

<title>Print Invoice</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{

background:#f5f5f5;
font-family:Arial, Helvetica, sans-serif;

}

.invoice{

width:210mm;
min-height:297mm;
margin:20px auto;
background:#fff;
border:2px solid #000;
padding:15px;

}

table{

width:100%;
border-collapse:collapse;

}

td,th{

border:1px solid #982128;
padding:5px;
font-size:13px;
vertical-align:top;

}

.title{

font-size:22px;
font-weight:bold;
text-align:center;
border:2px solid #000;
padding:8px;
margin-bottom:10px;

}

.company{

font-size:20px;
font-weight:bold;
color:#006400;

}

.print-btn{

margin:20px;

}

@media print{

.print-btn{

display:none;

}

body{

background:#fff;

}

.invoice{

margin:0;
border:none;
width:100%;

}

}

</style>

</head>

<body>

<div class="print-btn text-center">

<button
class="btn btn-primary"
onclick="window.print()">

Print Invoice

</button>

<a
href="index.php"
class="btn btn-secondary">

Back

</a>

</div>

<div class="invoice">

<div class="title">

TAX INVOICE

</div>

<table>

<tr>

<td width="55%">

<div class="company">

<?= $invoice['company_name']; ?>

</div>

<br>

<b>GSTIN/UIN :</b>

<?= $invoice['company_gstin']; ?>

<br><br>

<b>State :</b>

<?= $invoice['company_state']; ?>

<br><br>

<?= nl2br($invoice['company_address']); ?>

</td>

<td width="45%">

<table>

<tr>

<td>Invoice No.</td>

<td><?= $invoice['invoice_no']; ?></td>

</tr>

<tr>

<td>Date</td>

<td><?= date("d-m-Y",strtotime($invoice['invoice_date'])); ?></td>

</tr>

<tr>

<td>Delivery Note</td>

<td><?= $invoice['delivery_note']; ?></td>

</tr>

<tr>

<td>Buyer's Order No.</td>

<td><?= $invoice['buyer_order_no']; ?></td>

</tr>

<tr>

<td>Dispatch Doc No.</td>

<td><?= $invoice['dispatch_doc']; ?></td>

</tr>

<tr>

<td>Dispatch Through</td>

<td><?= $invoice['dispatch_through']; ?></td>

</tr>

<tr>

<td>Destination</td>

<td><?= $invoice['destination']; ?></td>

</tr>

</table>

</td>

</tr>

<tr>

<td>

<b>Consignee (Ship To)</b>

<br><br>

<?= $invoice['buyer_name']; ?>

<br>

GSTIN :

<?= $invoice['buyer_gstin']; ?>

<br>

State :

<?= $invoice['buyer_state']; ?>

<br><br>

<?= nl2br($invoice['buyer_address']); ?>

</td>

<td>

<b>Buyer (Bill To)</b>

<br><br>

<?= $invoice['buyer_name']; ?>

<br>

GSTIN :

<?= $invoice['buyer_gstin']; ?>

<br>

State :

<?= $invoice['buyer_state']; ?>

<br><br>

<?= nl2br($invoice['buyer_address']); ?>

</td>

</tr>

</table>

<br>
<!-- Product Table -->

<table>

<tr>

<th width="5%">Sr</th>
<th width="35%">Description of Goods</th>
<th width="12%">HSN/SAC</th>
<th width="8%">Qty</th>
<th width="10%">Unit</th>
<th width="12%">Rate</th>
<th width="8%">GST%</th>
<th width="15%">Amount</th>

</tr>

<?php

$i=1;

while($row=mysqli_fetch_assoc($items))
{

?>

<tr>

<td align="center">

<?= $i++; ?>

</td>

<td>

<?= $row['product_name']; ?>

</td>

<td align="center">

<?= $row['hsn']; ?>

</td>

<td align="center">

<?= $row['qty']; ?>

</td>

<td align="center">

<?= $row['unit']; ?>

</td>

<td align="right">

<?= number_format($row['rate'],2); ?>

</td>

<td align="center">

<?= $row['gst']; ?>%

</td>

<td align="right">

<?= number_format($row['amount'],2); ?>

</td>

</tr>

<?php } ?>

</table>

<br>

<!-- Total Section -->

<table>

<tr>

<td width="65%">

<b>Amount Chargeable (in words)</b>

<br><br>

<?= nl2br($invoice['amount_words']); ?>

</td>

<td width="35%">

<table>

<tr>

<td>

Sub Total

</td>

<td align="right">

₹ <?= number_format($invoice['subtotal'],2); ?>

</td>

</tr>

<tr>

<td>

CGST

</td>

<td align="right">

₹ <?= number_format($invoice['cgst'],2); ?>

</td>

</tr>

<tr>

<td>

SGST

</td>

<td align="right">

₹ <?= number_format($invoice['sgst'],2); ?>

</td>

</tr>

<tr>

<td>

<b>Grand Total</b>

</td>

<td align="right">

<b>

₹ <?= number_format($invoice['grand_total'],2); ?>

</b>

</td>

</tr>

</table>

</td>

</tr>

</table>

<br>
<!-- Declaration & Signature -->

<table>

<tr>

<td width="70%">

<b>Declaration</b>

<br><br>

<?php
if(!empty($invoice['declaration']))
{
    echo nl2br($invoice['declaration']);
}
else
{
?>
We declare that this invoice shows the actual price of the goods described herein and that all particulars are true and correct.
<?php
}
?>

<br><br>

<b>Bank Details</b>

<table style="margin-top:8px;">

<tr>

<td width="35%"><b>Bank Name</b></td>

<td>

<?= !empty($invoice['bank_name']) ? $invoice['bank_name'] : "__________________"; ?>

</td>

</tr>

<tr>

<td><b>Account No.</b></td>

<td>

<?= !empty($invoice['account_no']) ? $invoice['account_no'] : "__________________"; ?>

</td>

</tr>

<tr>

<td><b>IFSC Code</b></td>

<td>

<?= !empty($invoice['ifsc']) ? $invoice['ifsc'] : "__________________"; ?>

</td>

</tr>

</table>

</td>

<td width="30%" valign="bottom">

<div style="height:170px; position:relative;">

<div style="position:absolute; top:10px; right:10px; font-weight:bold;">

For <br>

<?= $invoice['company_name']; ?>

</div>

<div style="position:absolute; bottom:35px; right:10px;">

<?php
if(!empty($invoice['signatory']))
{
    echo "<b>".$invoice['signatory']."</b>";
}
?>

</div>

<div style="position:absolute; bottom:10px; right:10px; font-weight:bold;">

Authorised Signatory

</div>

</div>

</td>

</tr>

</table>

<br>

<div style="text-align:center;font-size:12px;">

This is a Computer Generated Invoice.

</div>

</div>

</body>

</html>