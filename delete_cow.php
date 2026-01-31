<?php
session_start();
include "includes/db.php";

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user']['id'];

if (!isset($_GET['id'])) {
    header("Location: view_cows.php");
    exit();
}

$cow_id = intval($_GET['id']);

mysqli_query(
    $conn,
    "DELETE FROM cows WHERE id='$cow_id' AND user_id='$user_id'"
);

header("Location: view_cows.php");
exit();
