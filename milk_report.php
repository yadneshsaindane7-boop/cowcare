<?php
session_start();
include "includes/db.php";

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user']['id'];

$daily = mysqli_fetch_assoc(mysqli_query(
    $conn,
    "SELECT SUM(milk_liters) AS total FROM milk_records
     WHERE user_id='$user_id' AND record_date = CURDATE()"
));

$monthly = mysqli_fetch_assoc(mysqli_query(
    $conn,
    "SELECT SUM(milk_liters) AS total FROM milk_records
     WHERE user_id='$user_id' AND MONTH(record_date) = MONTH(CURDATE())
     AND YEAR(record_date) = YEAR(CURDATE())"
));

include "includes/header.php";
?>

<h3 class="mb-4">Milk Production Report</h3>

<div class="card p-4 mb-3">
    <h5>Today’s Milk Production</h5>
    <p><?php echo $daily['total'] ?? 0; ?> Liters</p>
</div>

<div class="card p-4">
    <h5>This Month’s Milk Production</h5>
    <p><?php echo $monthly['total'] ?? 0; ?> Liters</p>
</div>

<?php include "includes/footer.php"; ?>
