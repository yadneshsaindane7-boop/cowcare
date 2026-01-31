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

$cow = mysqli_fetch_assoc(mysqli_query(
    $conn,
    "SELECT * FROM cows WHERE id='$cow_id' AND user_id='$user_id'"
));

if (!$cow) {
    die("Access denied");
}

if (isset($_POST['update'])) {
    $tag_no = safe($_POST['tag_no']);
    $breed = safe($_POST['breed']);
    $age = intval($_POST['age']);
    $health = safe($_POST['health_status']);

    mysqli_query(
        $conn,
        "UPDATE cows 
         SET tag_no='$tag_no', breed='$breed', age='$age', health_status='$health'
         WHERE id='$cow_id' AND user_id='$user_id'"
    );

    header("Location: view_cows.php");
    exit();
}

include "includes/header.php";
?>

<h3 class="mb-4">Edit Cow</h3>

<form method="post" class="card card-body">
    <div class="mb-3">
        <label>Tag No</label>
        <input type="text" name="tag_no" class="form-control" 
               value="<?php echo htmlspecialchars($cow['tag_no']); ?>" required>
    </div>

    <div class="mb-3">
        <label>Breed</label>
        <input type="text" name="breed" class="form-control" 
               value="<?php echo htmlspecialchars($cow['breed']); ?>" required>
    </div>

    <div class="mb-3">
        <label>Age</label>
        <input type="number" name="age" class="form-control" 
               value="<?php echo $cow['age']; ?>" required>
    </div>

    <div class="mb-3">
        <label>Health Status</label>
        <input type="text" name="health_status" class="form-control" 
               value="<?php echo htmlspecialchars($cow['health_status']); ?>" required>
    </div>

    <button type="submit" name="update" class="btn btn-primary">
        Update Cow
    </button>

    <a href="view_cows.php" class="btn btn-secondary ms-2">
        Cancel
    </a>
</form>

<?php include "includes/footer.php"; ?>
