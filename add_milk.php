<?php
session_start();
include "includes/db.php";

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user']['id'];

$cows = mysqli_query(
    $conn,
    "SELECT id, tag_no FROM cows WHERE user_id='$user_id'"
);

if (isset($_POST['add'])) {
    $cow_id = $_POST['cow_id'];
    $milk = safe($_POST['milk']);
    $date = safe($_POST['date']);

    if ($cow_id === 'all') {
        mysqli_query(
            $conn,
            "INSERT INTO milk_records (user_id, cow_id, milk_liters, record_date)
             VALUES ('$user_id', NULL, '$milk', '$date')"
        );
    } else {
        mysqli_query(
            $conn,
            "INSERT INTO milk_records (user_id, cow_id, milk_liters, record_date)
             VALUES ('$user_id', '$cow_id', '$milk', '$date')"
        );
    }

    $msg = "Milk record added successfully";
}

include "includes/header.php";
?>

<h3 class="mb-3">Add Milk Record</h3>

<?php if (isset($msg)) { ?>
    <div class="alert alert-success"><?php echo $msg; ?></div>
<?php } ?>

<form method="post" class="card p-4 shadow-sm">

    <div class="mb-3">
        <label class="form-label">Cow</label>
        <select name="cow_id" class="form-control" required>
            <option value="all">All Cows (Total Production)</option>
            <?php while ($c = mysqli_fetch_assoc($cows)) { ?>
                <option value="<?php echo $c['id']; ?>">
                    <?php echo htmlspecialchars($c['tag_no']); ?>
                </option>
            <?php } ?>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Milk (Liters)</label>
        <input type="number" step="0.01" name="milk" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Date</label>
        <input type="date" name="date" class="form-control" required>
    </div>

    <button class="btn btn-primary" name="add">Add Milk Record</button>
</form>

<?php include "includes/footer.php"; ?>
