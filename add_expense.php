<?php
session_start();
include "includes/db.php";

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user']['id'];

if (isset($_POST['add'])) {
    $expense_type = safe($_POST['expense_type']);
    $amount = safe($_POST['amount']);
    $date = safe($_POST['date']);

    mysqli_query(
        $conn,
        "INSERT INTO expenses 
        (user_id, expense_type, amount, record_date)
        VALUES 
        ('$user_id', '$expense_type', '$amount', '$date')"
    );

    $msg = "Expense added successfully";
}

include "includes/header.php";
?>

<h3 class="mb-3">Add Expense</h3>

<?php if (isset($msg)) { ?>
    <div class="alert alert-success"><?php echo $msg; ?></div>
<?php } ?>

<form method="post" class="card p-4 shadow-sm">

    <div class="mb-3">
        <label class="form-label">Expense Type</label>
        <input type="text" name="expense_type" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Amount (₹)</label>
        <input type="number" step="0.01" name="amount" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Date</label>
        <input type="date" name="date" class="form-control" required>
    </div>

    <button class="btn btn-primary" name="add">Add Expense</button>
</form>

<?php include "includes/footer.php"; ?>
