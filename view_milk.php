<?php
session_start();
include "includes/db.php";

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user']['id'];

$result = mysqli_query(
    $conn,
    "SELECT milk_records.*, cows.tag_no
     FROM milk_records
     LEFT JOIN cows ON milk_records.cow_id = cows.id
     WHERE milk_records.user_id='$user_id'
     ORDER BY milk_records.record_date DESC"
);

include "includes/header.php";
?>

<h3 class="mb-3">Milk Records</h3>

<table class="table table-bordered table-striped">
    <tr>
        <th>Cow</th>
        <th>Milk (Liters)</th>
        <th>Date</th>
    </tr>

    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
    <tr>
        <td><?php echo $row['tag_no'] ? $row['tag_no'] : 'All Cows'; ?></td>
        <td><?php echo $row['milk_liters']; ?></td>
        <td><?php echo $row['record_date']; ?></td>
    </tr>
    <?php } ?>
</table>

<?php include "includes/footer.php"; ?>
