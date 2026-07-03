<?php

include("../includes/auth.php");
include("../includes/db.php");
include("../includes/header.php");
include("../includes/sidebar.php");

$result=mysqli_query($conn,"
SELECT *
FROM invoices
ORDER BY id DESC
");

?>

<div class="main">

<div class="topbar">

<h3>

Invoice Management

</h3>

<a href="add.php" class="btn btn-primary">

<i class="fa-solid fa-plus"></i>

New Invoice

</a>

</div>

<div class="card">

<div class="card-body">

<table
class="table table-bordered table-hover"
id="invoiceTable">

<thead class="table-dark">

<tr>

<th width="5%">#</th>

<th>Invoice No</th>

<th>Date</th>

<th>Buyer</th>

<th>GSTIN</th>

<th>Total</th>

<th width="18%">Action</th>

</tr>

</thead>

<tbody>

<?php

$i=1;

while($row=mysqli_fetch_assoc($result))
{

?>

<tr>

<td>

<?= $i++; ?>

</td>

<td>

<?= $row['invoice_no']; ?>

</td>

<td>

<?= date("d-m-Y",strtotime($row['invoice_date'])); ?>

</td>

<td>

<?= $row['buyer_name']; ?>

</td>

<td>

<?= $row['buyer_gstin']; ?>

</td>

<td>

₹ <?= number_format($row['grand_total'],2); ?>

</td>

<td>

<a
href="print.php?id=<?= $row['id'];?>"
class="btn btn-info btn-sm">

<i class="fa-solid fa-print"></i>

</a>

<a
href="edit.php?id=<?= $row['id'];?>"
class="btn btn-warning btn-sm">

<i class="fa-solid fa-pen"></i>

</a>

<a
href="delete.php?id=<?= $row['id'];?>"
class="btn btn-danger btn-sm"
onclick="return confirm('Delete Invoice ?')">

<i class="fa-solid fa-trash"></i>

</a>

</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

</div>
</div>

<script>

$(document).ready(function(){

$('#invoiceTable').DataTable({

responsive:true,

pageLength:10,

order:[[0,'desc']],

language:{

search:"Search Invoice :",

lengthMenu:"Show _MENU_ Records",

zeroRecords:"No Invoice Found",

info:"Showing _START_ to _END_ of _TOTAL_ Invoices",

paginate:{

previous:"Previous",

next:"Next"

}

},

dom:'Bfrtip',

buttons:[

{

extend:'excel',

className:'btn btn-success btn-sm',

text:'<i class="fa-solid fa-file-excel"></i> Excel'

},

{

extend:'pdf',

className:'btn btn-danger btn-sm',

text:'<i class="fa-solid fa-file-pdf"></i> PDF'

},

{

extend:'print',

className:'btn btn-primary btn-sm',

text:'<i class="fa-solid fa-print"></i> Print'

}

]

});

});

</script>

<style>

.dataTables_wrapper .dt-buttons{

margin-bottom:15px;

}

.dataTables_wrapper .dt-buttons .btn{

margin-right:8px;

}

#invoiceTable th{

text-align:center;

vertical-align:middle;

}

#invoiceTable td{

vertical-align:middle;

}

#invoiceTable td:last-child{

text-align:center;

}

.btn-sm{

margin-right:4px;

}

.card{

border-radius:10px;

box-shadow:0 2px 10px rgba(0,0,0,.08);

}

</style>

<?php include("../includes/footer.php"); ?>