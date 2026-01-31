<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

include "includes/header.php";
?>

<h2 class="mb-4 translate-me">Cow Care Dashboard</h2>

<div class="list-group shadow-sm">
    <a href="add_cow.php" class="list-group-item list-group-item-action">➕ <span class="translate-me">Add Cow</span></a>
    <a href="view_cows.php" class="list-group-item list-group-item-action">📋 <span class="translate-me">View Cows</span></a>
    <a href="add_health.php" class="list-group-item list-group-item-action">🩺 <span class="translate-me">Add Health Record</span></a>
    <a href="view_health.php" class="list-group-item list-group-item-action">📊 <span class="translate-me">View Health Records</span></a>
    <a href="add_milk.php" class="list-group-item list-group-item-action">🥛 <span class="translate-me">Add Milk Record</span></a>
    <a href="view_milk.php" class="list-group-item list-group-item-action">📈 <span class="translate-me">View Milk Production</span></a>
    <a href="milk_report.php" class="list-group-item list-group-item-action">📊 <span class="translate-me">Milk Reports</span></a>
    <a href="add_feed.php" class="list-group-item list-group-item-action">🌾 <span class="translate-me">Feed Management</span></a>
    <a href="add_expense.php" class="list-group-item list-group-item-action">💰 <span class="translate-me">Add Expense</span></a>
    <a href="expense_report.php" class="list-group-item list-group-item-action">📉 <span class="translate-me">Expense Summary</span></a>
    <a href="profit_loss.php" class="list-group-item list-group-item-action">📈 <span class="translate-me">Profit / Loss</span></a>
    <a href="info.php" class="list-group-item list-group-item-action">ℹ️ <span class="translate-me">Cow Care Info</span></a>
    <a href="ai_assistant.php" class="list-group-item list-group-item-action bg-light fw-bold text-primary">🤖 <span class="translate-me">AI Cattle Assistant</span></a>
</div>

<?php include "includes/footer.php"; ?>