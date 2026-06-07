<?php
session_start();
include("../config/database.php");

if(!isset($_SESSION['user_id']) || $_SESSION['role_id'] != 1){
    header("Location: ../login.php");
    exit();
}

$id = $_GET['id'];

$sql = "UPDATE loans 
        SET status='Rejected'
        WHERE loan_id='$id'";

if(mysqli_query($conn, $sql)){
    header("Location: loans.php");
    exit();
} else {
    echo "Error rejecting loan";
}
?>