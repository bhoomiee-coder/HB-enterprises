// ---------------- Product Calculation ----------------

function calculateRow(row){

    let qty = parseFloat(row.querySelector(".qty").value) || 0;
    let rate = parseFloat(row.querySelector(".rate").value) || 0;

    let amount = qty * rate;

    row.querySelector(".amount").value = amount.toFixed(2);

    calculateTotal();
}

// ---------------- Grand Total ----------------

function calculateTotal(){

    let subtotal = 0;

    document.querySelectorAll(".amount").forEach(function(item){

        subtotal += parseFloat(item.value) || 0;

    });

    let cgst = subtotal * 0.09;
    let sgst = subtotal * 0.09;
    let grand = subtotal + cgst + sgst;

    document.getElementById("subtotal").value = subtotal.toFixed(2);
    document.getElementById("cgst").value = cgst.toFixed(2);
    document.getElementById("sgst").value = sgst.toFixed(2);
    document.getElementById("grandtotal").value = grand.toFixed(2);

    document.getElementById("amount_words").value =
        "Rupees " + grand.toFixed(2) + " Only";
}

// ---------------- Product Change ----------------

document.addEventListener("change",function(e){

    if(e.target.classList.contains("product")){

        let row = e.target.closest("tr");

        let option = e.target.options[e.target.selectedIndex];

        row.querySelector(".rate").value = option.dataset.price || "";
        row.querySelector(".hsn").value = option.dataset.hsn || "";
        row.querySelector(".unit").value = option.dataset.unit || "";

        calculateRow(row);
    }

});

// ---------------- Qty / Rate Change ----------------

document.addEventListener("keyup",function(e){

    if(e.target.classList.contains("qty") || e.target.classList.contains("rate")){

        calculateRow(e.target.closest("tr"));

    }

});

// ---------------- Add Row ----------------

document.addEventListener("click",function(e){

    if(e.target.classList.contains("addRow")){

        let tbody = document.getElementById("productBody");

        let clone = tbody.rows[0].cloneNode(true);

        clone.querySelector(".product").selectedIndex = 0;
        clone.querySelector(".hsn").value = "";
        clone.querySelector(".qty").value = 1;
        clone.querySelector(".unit").value = "";
        clone.querySelector(".rate").value = "";
        clone.querySelector(".amount").value = "";

        clone.cells[0].innerHTML = tbody.rows.length + 1;

        clone.cells[8].innerHTML =
        '<button type="button" class="btn btn-danger removeRow">-</button>';

        tbody.appendChild(clone);

    }

});

// ---------------- Delete Row ----------------

document.addEventListener("click",function(e){

    if(e.target.classList.contains("removeRow")){

        e.target.closest("tr").remove();

        let rows=document.querySelectorAll("#productBody tr");

        rows.forEach(function(r,index){

            r.cells[0].innerHTML=index+1;

        });

        calculateTotal();

    }

});