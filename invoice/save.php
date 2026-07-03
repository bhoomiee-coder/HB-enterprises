<?php

include("../includes/auth.php");
include("../includes/db.php");

if(isset($_POST['invoice_no']))
{

mysqli_begin_transaction($conn);

try{

//======================
// Invoice Header
//======================

$invoice_no       = $_POST['invoice_no'];
$invoice_date     = $_POST['invoice_date'];

$company_name     = $_POST['company_name'];
$company_gstin    = $_POST['company_gstin'];
$company_state    = $_POST['company_state'];
$company_address  = $_POST['company_address'];

$buyer_name       = $_POST['buyer_name'];
$buyer_gstin      = $_POST['buyer_gstin'];
$buyer_state      = $_POST['buyer_state'];
$buyer_address    = $_POST['buyer_address'];

$delivery_note    = $_POST['delivery_note'];
$buyer_order_no   = $_POST['buyer_order_no'];
$dispatch_doc     = $_POST['dispatch_doc'];
$dispatch_through = $_POST['dispatch_through'];
$destination      = $_POST['destination'];

$terms            = $_POST['terms'];
$amount_words     = $_POST['amount_words'];
$declaration      = $_POST['declaration'];

$bank_name        = $_POST['bank_name'];
$account_no       = $_POST['account_no'];
$ifsc             = $_POST['ifsc'];
$signatory        = $_POST['signatory'];

$subtotal         = $_POST['subtotal'];
$cgst             = $_POST['cgst'];
$sgst             = $_POST['sgst'];
$grand_total      = $_POST['grand_total'];

$sql = "INSERT INTO invoices(

invoice_no,
invoice_date,

company_name,
company_gstin,
company_state,
company_address,

buyer_name,
buyer_gstin,
buyer_state,
buyer_address,

delivery_note,
buyer_order_no,
dispatch_doc,
dispatch_through,
destination,

terms,

subtotal,
cgst,
sgst,
grand_total,

amount_words,
declaration,

bank_name,
account_no,
ifsc,
signatory

)

VALUES(

'$invoice_no',
'$invoice_date',

'$company_name',
'$company_gstin',
'$company_state',
'$company_address',

'$buyer_name',
'$buyer_gstin',
'$buyer_state',
'$buyer_address',

'$delivery_note',
'$buyer_order_no',
'$dispatch_doc',
'$dispatch_through',
'$destination',

'$terms',

'$subtotal',
'$cgst',
'$sgst',
'$grand_total',

'$amount_words',
'$declaration',

'$bank_name',
'$account_no',
'$ifsc',
'$signatory'

)";

mysqli_query($conn,$sql);

$invoice_id = mysqli_insert_id($conn);
//======================
// Save Invoice Items
//======================

for($i=0;$i<count($_POST['product_id']);$i++)
{

$product_id = $_POST['product_id'][$i];

if($product_id=="")
{
    continue;
}

// Product Details
$p = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM products WHERE id='$product_id'"));

$product_name = $p['product_name'];
$hsn          = $p['hsn'];
$unit         = $p['unit'];

$qty    = $_POST['qty'][$i];
$rate   = $_POST['rate'][$i];
$gst    = $_POST['gst'][$i];
$amount = $_POST['amount'][$i];

// Insert Item

mysqli_query($conn,"INSERT INTO invoice_items(

invoice_id,
product_id,
product_name,
hsn,
unit,
qty,
rate,
gst,
amount

)

VALUES(

'$invoice_id',
'$product_id',
'$product_name',
'$hsn',
'$unit',
'$qty',
'$rate',
'$gst',
'$amount'

)");

}

//======================
// Commit Transaction
//======================

mysqli_commit($conn);

// Redirect

header("Location:print.php?id=".$invoice_id);

exit();

}

catch(Exception $e)
{

mysqli_rollback($conn);

echo "Error : ".mysqli_error($conn);

}

}

else
{

header("Location:add.php");

}

?>