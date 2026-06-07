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

        .pending{ color:orange; }
        .approved{ color:green; }
        .rejected{ color:red; }
    </style>
</head>

<body>

<div class="container">

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

    <td><?php echo $row['fullname']; ?></td>
    <td><?php echo $row['amount']; ?></td>
    <td><?php echo $row['interest_rate']; ?>%</td>
    <td><?php echo $row['duration_months']; ?> months</td>
    <td><?php echo $row['purpose']; ?></td>

    <td>
        <?php echo $row['status']; ?>
    </td>

    <td>

        <?php if($row['status'] == 'Pending'){ ?>

            <a href="approve_loan.php?id=<?php echo $row['loan_id']; ?>" style="color:green;">Approve</a> |
            <a href="reject_loan.php?id=<?php echo $row['loan_id']; ?>" style="color:red;">Reject</a>

        <?php } else { ?>

            <span>No action</span>

        <?php } ?>

    </td>

</tr>

        <?php } ?>

    </table>

</div>

</body>
</html>
