<?php
session_start();
include "includes/db.php";

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user']['id'];

if (isset($_POST['add'])) {
    $tag = safe($_POST['tag']);
    $breed = safe($_POST['breed']);
    $age = safe($_POST['age']);
    $health = safe($_POST['health']);

    mysqli_query(
        $conn,
        "INSERT INTO cows (user_id, tag_no, breed, age, health_status)
         VALUES ('$user_id','$tag','$breed','$age','$health')"
    );

    $msg = "Cow added successfully";
}

include "includes/header.php";
?>

<h3>Add Cow</h3>

<?php if (isset($msg)) echo "<div class='alert alert-success'>$msg</div>"; ?>

<form method="post">
    <input name="tag" placeholder="Tag No" required><br><br>
    <input name="breed" placeholder="Breed" required><br><br>
    <input type="number" name="age" placeholder="Age" required><br><br>
    <input name="health" placeholder="Health Status" required><br><br>
    <button name="add">Add Cow</button>
</form>

<?php include "includes/footer.php"; ?>
