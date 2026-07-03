$(document).ready(function(){

if($("#userTable").length){

$("#userTable").DataTable({

responsive:true,

pageLength:10,

dom:'Bfrtip',

buttons:[

'copy',

'excel',

'pdf',

'print'

]

});

}

});