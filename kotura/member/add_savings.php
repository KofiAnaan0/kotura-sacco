<?php
session_start();

if(!isset($_SESSION['user_id']) || $_SESSION['role_id'] != 3){
    header("Location: ../login.php");
    exit();
}

include("../config/database.php");

if(isset($_POST['save'])){
    $amount = $_POST['amount'];
    $savings_date = $_POST['savings_date'];

    // Get the latest member ID
    $member_query = "SELECT member_id FROM members ORDER BY member_id DESC LIMIT 1";
    $member_result = mysqli_query($conn, $member_query);
    $member_row = mysqli_fetch_assoc($member_result);
    $member_id = $member_row['member_id'] ?? 1;

    $sql = "INSERT INTO savings (member_id, amount, savings_date)
            VALUES ('$member_id', '$amount', '$savings_date')";

    if(mysqli_query($conn, $sql)){
        echo "<script>alert('Savings recorded successfully!'); window.location='dashboard.php';</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Record Savings - KOTURA SACCO</title>
    <link rel="stylesheet" href="../assets/css/dashboard.css">
    <style>
        body { font-family: Arial; background: #f4f6f9; padding: 20px; }
        .box { background: white; padding: 30px; max-width: 600px; margin: auto; border-radius: 10px; }
        input, textarea { width: 100%; padding: 10px; margin: 10px 0; box-sizing: border-box; }
        button { padding: 10px 20px; background: green; color: white; border: none; cursor: pointer; border-radius: 5px; }
        button:hover { background: darkgreen; }
        a { text-decoration: none; color: #1e3a8a; }
    </style>
</head>
<body>

<div class="box">
    <h2>Record Personal Savings</h2>
    <p><a href="dashboard.php">← Back to Dashboard</a></p>

    <form method="POST">
        <label>Amount Saved (UGX)</label>
        <input type="number" name="amount" placeholder="Amount" step="0.01" required>

        <label>Date</label>
        <input type="date" name="savings_date" required>

        <button type="submit" name="save">Record Savings</button>
    </form>
</div>

</body>
</html>
