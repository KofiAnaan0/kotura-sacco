<?php
session_start();

// Only staff allowed
if(!isset($_SESSION['user_id']) || $_SESSION['role_id'] != 2){
    header("Location: ../login.php");
    exit();
}

include("../config/database.php");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Staff Dashboard - KOTURA SACCO</title>

    <style>
        body{
            margin:0;
            font-family: Arial;
            background:#f4f6f9;
        }

        .sidebar{
            width:220px;
            height:100vh;
            background:#0f172a;
            color:white;
            position:fixed;
            padding:20px;
        }

        .sidebar h2{
            text-align:center;
            margin-bottom:30px;
        }

        .sidebar a{
            display:block;
            color:white;
            text-decoration:none;
            padding:10px;
            margin:5px 0;
            border-radius:5px;
        }

        .sidebar a:hover{
            background:#1e3a8a;
        }

        .main{
            margin-left:240px;
            padding:20px;
        }

        .card{
            background:white;
            padding:20px;
            margin:10px;
            border-radius:10px;
            display:inline-block;
            width:200px;
            box-shadow:0 2px 6px rgba(0,0,0,0.1);
        }

        .welcome{
            background:white;
            padding:15px;
            border-radius:10px;
            margin-bottom:20px;
        }

        .topbar{
            background:#1e3a8a;
            color:white;
            padding:15px;
            margin-left:220px;
        }
    </style>
</head>

<body>

<!-- TOP BAR -->
<div class="topbar">
    Welcome Staff: <?php echo $_SESSION['fullname']; ?>
</div>

<!-- SIDEBAR -->
<div class="sidebar">

    <h2>STAFF PANEL</h2>

    <a href="dashboard.php">Dashboard</a>

    <a href="add_member.php">Add Member</a>

    <a href="../admin/members.php">View Members</a>

    <a href="add_savings.php">Record Savings</a>

    <a href="../admin/savings.php">View Savings</a>

    <a href="apply_loan.php">Apply Loan</a>

    <a href="../admin/loans.php">View Loans</a>
    <a href="add_repayment.php">Record Repayment</a>
    <a href="../admin/repayments.php">View Repayments</a>

    <a href="../logout.php">Logout</a>

</div>

<!-- MAIN CONTENT -->
<div class="main">

    <div class="welcome">
        <h2>Staff Dashboard</h2>
        <p>Manage members, savings, and loan applications.</p>
    </div>

    <div class="card">
        <h3>Members</h3>
        <p>Manage SACCO members</p>
    </div>

    <div class="card">
        <h3>Savings</h3>
        <p>Record member savings</p>
    </div>

    <div class="card">
        <h3>Loans</h3>
        <p>Handle loan applications</p>
    </div>

</div>

</body>
</html>