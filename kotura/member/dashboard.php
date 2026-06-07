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
  <style>
    .sidebar { background: #1e3a8a; width: 250px; float: left; height: 100vh; padding: 20px 0; }
    .sidebar h2 { color: white; padding: 0 20px; margin: 20px 0; }
    .sidebar a { display: block; padding: 12px 20px; color: white; text-decoration: none; }
    .sidebar a:hover { background: rgba(255,255,255,0.1); }
    .main { margin-left: 250px; padding: 30px; }
    .cards { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin: 20px 0; }
    .card { background: white; padding: 20px; border-radius: 10px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); text-align: center; }
    .content-box { background: white; padding: 20px; border-radius: 10px; margin: 20px 0; }
    .content-box ul { list-style: none; padding: 0; }
    .content-box li { padding: 10px 0; }
    .content-box a { color: #1e3a8a; text-decoration: none; }
    .content-box a:hover { text-decoration: underline; }
  </style>
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
  <p style="font-size: 18px;">Welcome <strong><?php echo htmlspecialchars($_SESSION['fullname']); ?></strong>! 👋</p>

  <div class="cards">
    <div class="card">
      <h3>💰 My Savings</h3>
      <p>Manage your savings account</p>
    </div>
    <div class="card">
      <h3>📄 Loan Status</h3>
      <p>Check your loan application</p>
    </div>
    <div class="card">
      <h3>🧾 Apply Loan</h3>
      <p>Request a new loan</p>
    </div>
    <div class="card">
      <h3>👤 Profile</h3>
      <p>View your information</p>
    </div>
  </div>

  <div class="content-box">
    <h3>Quick Links</h3>
    <ul>
      <li><a href="add_savings.php">➕ Record Personal Savings</a></li>
      <li><a href="apply_loan.php">📋 Apply for Loan</a></li>
      <li><a href="loan_status.php">📊 Check Loan Application Status</a></li>
      <li><a href="profile.php">👤 View My Profile</a></li>
    </ul>
  </div>

  <div class="content-box">
    <h3>Account Information</h3>
    <p>You are logged in as a member. Use the menu above to navigate through your account features.</p>
    <p>If you need assistance, please contact the SACCO office.</p>
  </div>
</div>

</body>
</html>
