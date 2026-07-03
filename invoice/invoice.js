document.addEventListener("input", function (e) {
    let row = e.target.closest("tr");
    if (!row) return;

    if (e.target.classList.contains("product")) {
        let option = e.target.options[e.target.selectedIndex];

        row.querySelector(".rate").value = option.dataset.price || 0;
        row.querySelector(".hsn").value = option.dataset.hsn || "";

        calculateRow(row);
    }

    if (
        e.target.classList.contains("qty") ||
        e.target.classList.contains("rate")
    ) {
        calculateRow(row);
    }
});

function calculateRow(row) {
    let qty = Number(row.querySelector(".qty").value);
    let rate = Number(row.querySelector(".rate").value);

    if (isNaN(qty)) qty = 0;
    if (isNaN(rate)) rate = 0;

    let amount = qty * rate;

    row.querySelector(".amount").value = amount.toFixed(2);

    calculateTotal();
}

function calculateTotal() {
    let subtotal = 0;

    document.querySelectorAll(".amount").forEach(el => {
        let val = parseFloat(el.value);
        if (!isNaN(val)) subtotal += val;
    });

    subtotal = Number(subtotal) || 0;

    let gst = subtotal * 0.18;
    gst = Number(gst) || 0;

    let grand = subtotal + gst;
    grand = Number(grand) || 0;

    document.getElementById("subtotal").value = subtotal.toFixed(2);
    document.getElementById("cgst").value = (gst / 2).toFixed(2);
    document.getElementById("sgst").value = (gst / 2).toFixed(2);
    document.getElementById("grandtotal").value = grand.toFixed(2);

    updateWords(grand);
}
function updateWords(amount) {
    let el = document.getElementById("amount_words");

    amount = Math.floor(Number(amount));

    if (isNaN(amount) || amount <= 0) {
        el.value = "Zero Only";
        return;
    }

    el.value = numberToWords(amount);
}
function numberToWords(num) {
    num = Math.floor(Number(num));

    if (isNaN(num) || num === 0) return "Zero Only";

    const a = [
        "", "One", "Two", "Three", "Four", "Five",
        "Six", "Seven", "Eight", "Nine", "Ten",
        "Eleven", "Twelve", "Thirteen", "Fourteen",
        "Fifteen", "Sixteen", "Seventeen", "Eighteen", "Nineteen"
    ];

    const b = [
        "", "", "Twenty", "Thirty", "Forty", "Fifty",
        "Sixty", "Seventy", "Eighty", "Ninety"
    ];

    function twoDigits(n) {
        if (n < 20) return a[n];
        return b[Math.floor(n / 10)] + (n % 10 ? " " + a[n % 10] : "");
    }

    function threeDigits(n) {
        let str = "";
        if (n > 99) {
            str += a[Math.floor(n / 100)] + " Hundred ";
            n = n % 100;
        }
        if (n > 0) {
            str += twoDigits(n);
        }
        return str.trim();
    }

    let result = "";

    if (num >= 100000) {
        result += threeDigits(Math.floor(num / 100000)) + " Lakh ";
        num = num % 100000;
    }

    if (num >= 1000) {
        result += threeDigits(Math.floor(num / 1000)) + " Thousand ";
        num = num % 1000;
    }

    if (num > 0) {
        result += threeDigits(num);
    }

    return result.trim() + " Only";
}