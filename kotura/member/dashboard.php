<?php
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: ../login.php");
    exit();
}

if($_SESSION['role_id'] != 3){
    header("Location: ../login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Member Dashboard - KOTURA SACCO</title>
  <link rel="stylesheet" href="../assets/css/dashboard.css">
</head>
<body>

<div class="sidebar">
  <h2>KOTURA MEMBER</h2>
  <a href="dashboard.php">Dashboard</a>
  <a href="add_savings.php">My Savings</a>
  <a href="apply_loan.php">Apply Loan</a>
  <a href="loan_status.php">Loan Status</a>
  <a href="profile.php">Profile</a>
  <a href="../logout.php">Logout</a>
</div>

<div class="main">
  <h1>Member Dashboard</h1>
  <p>Welcome <strong><?php echo $_SESSION['fullname']; ?></strong></p>

  <div class="cards">
    <div class="card">💰 Savings</div>
    <div class="card">📄 Loan Status</div>
    <div class="card">🧾 Loan Application</div>
    <div class="card">👤 Profile</div>
  </div>

  <div class="content-box">
    <h3>Quick Links</h3>
    <ul>
      <li><a href="add_savings.php">Record Personal Savings</a></li>
      <li><a href="apply_loan.php">Apply for Loan</a></li>
      <li><a href="loan_status.php">Check Loan Application Status</a></li>
      <li><a href="profile.php">View My Profile</a></li>
    </ul>
  </div>
</div>

</body>
</html>
  </div>

  <div class="content-box">
    <h3>Welcome Member</h3>
    <p>View your savings, loans, and account activity.</p>
  </div>
</div>

</body>
</html>