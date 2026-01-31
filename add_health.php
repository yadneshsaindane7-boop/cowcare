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

    $cow_id = (int) $_POST['cow_id'];
    $disease = mysqli_real_escape_string($conn, $_POST['disease']);
    $treatment = mysqli_real_escape_string($conn, $_POST['treatment']);
    $date = mysqli_real_escape_string($conn, $_POST['date']);

    if ($cow_id <= 0) {
        die("Invalid cow selected");
    }

    mysqli_query(
        $conn,
        "INSERT INTO health_records
        (cow_id, disease, treatment, record_date, user_id)
        VALUES
        ('$cow_id', '$disease', '$treatment', '$date', '$user_id')"
    );

    mysqli_query(
        $conn,
        "UPDATE cows
         SET health_status='Sick'
         WHERE id='$cow_id' AND user_id='$user_id'"
    );

    $msg = "Health record added successfully";
}

include "includes/header.php";
?>

<h3 class="mb-3">Add Health Record</h3>

<?php if (isset($msg)) { ?>
    <div class="alert alert-success"><?php echo $msg; ?></div>
<?php } ?>

<form method="post" class="card p-4 shadow-sm" style="max-width:600px;">

    <div class="mb-3">
        <label class="form-label">Cow</label>
        <select name="cow_id" class="form-control" required>
            <option value="">-- Select Cow --</option>
            <?php while ($c = mysqli_fetch_assoc($cows)) { ?>
                <option value="<?php echo $c['id']; ?>">
                    <?php echo htmlspecialchars($c['tag_no']); ?>
                </option>
            <?php } ?>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Disease</label>
        <input type="text" name="disease" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Treatment Given</label>
        <textarea name="treatment" class="form-control" rows="3" required></textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">Date</label>
        <input type="date" name="date" class="form-control" required>
    </div>

    <button class="btn btn-primary" name="add">Add Health Record</button>
    <a href="dashboard.php" class="btn btn-secondary ms-2">Back</a>
</form>

<?php include "includes/footer.php"; ?>
