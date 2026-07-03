<?php
include("../includes/auth.php");
include("../includes/header.php");
include("../includes/sidebar.php");
?>

<div class="main">
    <div class="topbar">
        <h3>Dashboard</h3>

        <div>
            Welcome,
            <b><?php echo $_SESSION['name']; ?></b>

            <span class="badge bg-primary">
                <?php echo $_SESSION['role']; ?>
            </span>
        </div>
    </div>

    

<?php
include("../includes/footer.php");
?>