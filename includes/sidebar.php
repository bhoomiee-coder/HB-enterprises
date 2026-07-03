<style>

/* ===========================
   PREMIUM BLACK GOLD SIDEBAR
=========================== */

.sidebar{

width:270px;
height:100vh;
position:fixed;
left:0;
top:0;
overflow-y:auto;

background:linear-gradient(180deg,#0f0f0f,#1b1b1b,#000);

box-shadow:5px 0 20px rgba(0,0,0,.35);

}

/* Scrollbar */

.sidebar::-webkit-scrollbar{

width:6px;

}

.sidebar::-webkit-scrollbar-thumb{

background:#c9a227;
border-radius:20px;

}

/* Logo */

.logo{

padding:30px 20px;
text-align:center;
border-bottom:1px solid rgba(201,162,39,.25);

}

.logo img{

width:90px;
transition:.3s;

}

.logo img:hover{

transform:scale(1.05);

}

.logo h3{

margin-top:10px;
font-size:24px;
font-weight:700;
letter-spacing:1px;
color:#d4af37;

}

/* Menu */

.sidebar ul{

padding:20px 12px;
list-style:none;

}

.sidebar ul li{

margin-bottom:8px;

}

/* Links */

.sidebar ul li a{

display:flex;
align-items:center;
gap:15px;

padding:15px 18px;

text-decoration:none;

color:#d1d5db;

font-size:15px;

font-weight:500;

border-radius:12px;

transition:.35s;

}

/* Icons */

.sidebar ul li a i{

width:22px;

font-size:18px;

color:#d4af37;

transition:.3s;

}

/* Hover */

.sidebar ul li a:hover{

background:linear-gradient(90deg,#d4af37,#b8860b);

color:#111;

padding-left:25px;

box-shadow:0 8px 18px rgba(212,175,55,.30);

}

.sidebar ul li a:hover i{

color:#111;

}

/* Active Menu */

.sidebar ul li a.active{

background:linear-gradient(90deg,#d4af37,#b8860b);

color:#111;

font-weight:600;

box-shadow:0 8px 18px rgba(212,175,55,.30);

}

.sidebar ul li a.active i{

color:#111;

}

/* Logout */

.logout{

position:absolute;
bottom:20px;
left:0;
width:100%;
padding:0 12px;

}

.logout a{

display:flex;
align-items:center;
gap:12px;

padding:15px;

border-radius:12px;

background:#2a2a2a;

color:#ff5c5c;

text-decoration:none;

transition:.3s;

}

.logout a:hover{

background:#d32f2f;

color:#fff;

}

/* Main */

.main{

margin-left:270px;
padding:25px;

}

/* Mobile */

@media(max-width:992px){

.sidebar{

left:-270px;
transition:.4s;

}

.sidebar.show{

left:0;

}

.main{

margin-left:0;

}

}
</style>

<div class="sidebar">

    <div class="logo">

        <img src="../uploads/products/images/logo.png" alt="HB Enterprises">

        <h3>HB ERP</h3>

    </div>

    <ul>

        <li>
            <a href="../admin/dashboard.php">
                <i class="fa-solid fa-gauge-high"></i>
                Dashboard
            </a>
        </li>

        <li>
            <a href="../products/index.php">
                <i class="fa-solid fa-box"></i>
                Products
            </a>
        </li>

        <li>
            <a href="../invoice/index.php">
                <i class="fa-solid fa-file-invoice"></i>
                Invoice
            </a>
        </li>

        <li>
            <a href="../users/index.php">
                <i class="fa-solid fa-users"></i>
                Users
            </a>
        </li>

       


    </ul>

    <div class="logout">

        <a href="../admin/logout.php">

            <i class="fa-solid fa-right-from-bracket"></i>

            Logout

        </a>

    </div>

</div>