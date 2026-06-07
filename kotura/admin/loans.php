<?php
session_start();
include("../config/database.php");

if(!isset($_SESSION['user_id']) || $_SESSION['role_id'] != 1){
    header("Location: ../login.php");
    exit();
}

$sql = "SELECT l.*, m.fullname 
        FROM loans l
        JOIN members m ON l.member_id = m.member_id
        ORDER BY l.loan_id DESC";

$result = mysqli_query($conn, $sql);

// Check for success/error messages
$success_message = isset($_SESSION['message']) ? $_SESSION['message'] : '';
$error_message = isset($_SESSION['error']) ? $_SESSION['error'] : '';
unset($_SESSION['message']);
unset($_SESSION['error']);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Loans</title>

    <style>
        body{
            font-family: Arial;
            background:#f4f6f9;
            padding:20px;
        }

        .container{
            background:white;
            padding:20px;
            border-radius:10px;
        }

        .message {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
            display: none;
        }

        .message.success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
            display: block;
        }

        .message.error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
            display: block;
        }

        table{
            width:100%;
            border-collapse:collapse;
        }

        th{
            background:#1e3a8a;
            color:white;
            padding:10px;
        }

        td{
            padding:10px;
            border:1px solid #ddd;
        }

        .pending{ color:orange; font-weight: bold; }
        .approved{ color:green; font-weight: bold; }
        .rejected{ color:red; font-weight: bold; }

        .action-links a {
            padding: 5px 10px;
            margin: 0 5px;
            border-radius: 3px;
            text-decoration: none;
            color: white;
        }

        .action-links a.approve {
            background: green;
        }

        .action-links a.reject {
            background: red;
        }

        .action-links a:hover {
            opacity: 0.8;
        }

        .back-link {
            margin-bottom: 20px;
        }

        .back-link a {
            color: #1e3a8a;
            text-decoration: none;
        }

        .back-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

<div class="container">

    <div class="back-link">
        <a href="dashboard.php">← Back to Dashboard</a>
    </div>

    <?php if($success_message): ?>
        <div class="message success">✓ <?php echo htmlspecialchars($success_message); ?></div>
    <?php endif; ?>

    <?php if($error_message): ?>
        <div class="message error">✗ <?php echo htmlspecialchars($error_message); ?></div>
    <?php endif; ?>

    <h2>Loan Applications</h2>

    <table>

        <tr>
            <th>Member</th>
            <th>Amount</th>
            <th>Interest</th>
            <th>Duration</th>
            <th>Purpose</th>
            <th>Status</th>
            <th>Action</th>
        </tr>

        <?php while($row = mysqli_fetch_assoc($result)) { ?>

        <tr>

            <td><?php echo htmlspecialchars($row['fullname']); ?></td>
            <td>UGX <?php echo number_format($row['amount'], 0); ?></td>
            <td><?php echo htmlspecialchars($row['interest_rate']); ?>%</td>
            <td><?php echo htmlspecialchars($row['duration_months']); ?> months</td>
            <td><?php echo htmlspecialchars($row['purpose']); ?></td>

            <td>
                <?php 
                    $status = htmlspecialchars($row['status']);
                    $class = strtolower($status);
                    echo "<span class='$class'>$status</span>";
                ?>
            </td>

            <td class="action-links">

                <?php if($row['status'] == 'Pending'){ ?>

                    <a href="approve_loan.php?id=<?php echo urlencode($row['loan_id']); ?>" class="approve" onclick="return confirm('Are you sure you want to approve this loan?');">Approve</a>
                    <a href="reject_loan.php?id=<?php echo urlencode($row['loan_id']); ?>" class="reject" onclick="return confirm('Are you sure you want to reject this loan?');">Reject</a>

                <?php } else { ?>

                    <span style="color:gray;">No action</span>

                <?php } ?>

            </td>

        </tr>

        <?php } ?>

    </table>

</div>

</body>
</html>
