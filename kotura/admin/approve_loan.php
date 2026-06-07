<?php
session_start();
include("../config/database.php");

if(!isset($_SESSION['user_id']) || $_SESSION['role_id'] != 1){
    header("Location: ../login.php");
    exit();
}

$id = $_GET['id'];

$admin_id = $_SESSION['user_id'];
$date = date("Y-m-d");

$sql = "UPDATE loans 
        SET status='Approved', 
            approved_by='$admin_id',
            approval_date='$date'
        WHERE loan_id='$id'";

if(mysqli_query($conn, $sql)){
    header("Location: loans.php");
    exit();
} else {
    echo "Error approving loan";
}
?>
