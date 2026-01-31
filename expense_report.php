<?php
session_start();
include "includes/db.php";

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user']['id'];

$feed = mysqli_fetch_assoc(mysqli_query(
    $conn,
    "SELECT SUM(cost) AS total FROM feed_records WHERE user_id='$user_id'"
));

$expense = mysqli_fetch_assoc(mysqli_query(
    $conn,
    "SELECT SUM(amount) AS total FROM expenses WHERE user_id='$user_id'"
));

include "includes/header.php";
?>

<h3 class="mb-4">Expense Summary</h3>

<div class="card p-4 mb-3">
    <h5>Total Feed Cost</h5>
    <p>₹ <?php echo $feed['total'] ?? 0; ?></p>
</div>

<div class="card p-4">
    <h5>Other Expenses</h5>
    <p>₹ <?php echo $expense['total'] ?? 0; ?></p>
</div>

<?php include "includes/footer.php"; ?>
