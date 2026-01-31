<?php
session_start();
include "includes/db.php";

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user']['id'];

if (isset($_POST['add'])) {
    $feed_type = safe($_POST['feed_type']);
    $quantity = safe($_POST['quantity']);
    $cost = safe($_POST['cost']);
    $date = safe($_POST['date']);

    mysqli_query(
        $conn,
        "INSERT INTO feed_records 
        (user_id, feed_type, quantity_kg, cost, record_date)
        VALUES 
        ('$user_id', '$feed_type', '$quantity', '$cost', '$date')"
    );

    $msg = "Feed record added successfully";
}

include "includes/header.php";
?>

<h3 class="mb-3">Add Feed Record</h3>

<?php if (isset($msg)) { ?>
    <div class="alert alert-success"><?php echo $msg; ?></div>
<?php } ?>

<form method="post" class="card p-4 shadow-sm">

    <div class="mb-3">
        <label class="form-label">Feed Type</label>
        <input type="text" name="feed_type" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Quantity (kg)</label>
        <input type="number" step="0.01" name="quantity" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Cost (₹)</label>
        <input type="number" step="0.01" name="cost" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Date</label>
        <input type="date" name="date" class="form-control" required>
    </div>

    <button class="btn btn-primary" name="add">Add Feed</button>
</form>

<?php include "includes/footer.php"; ?>
