<?php
session_start();
include("../config/database.php");

if(!isset($_SESSION['user_id']) || $_SESSION['role_id'] != 1){
    header("Location: ../login.php");
    exit();
}

$id = isset($_GET['id']) ? mysqli_real_escape_string($conn, $_GET['id']) : null;

if(!$id){
    header("Location: loans.php");
    exit();
}

$admin_id = $_SESSION['user_id'];
$date = date("Y-m-d");

$sql = "UPDATE loans 
        SET status='Approved', 
            approved_by='$admin_id',
            approval_date='$date'
        WHERE loan_id='$id'";

if(mysqli_query($conn, $sql)){
    $_SESSION['message'] = "Loan approved successfully!";
    header("Location: loans.php?success=1");
    exit();
} else {
    $_SESSION['error'] = "Error approving loan: " . mysqli_error($conn);
    header("Location: loans.php?error=1");
    exit();
}
?>
