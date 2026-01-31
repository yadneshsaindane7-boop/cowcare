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
    "SELECT 
        h.record_date,
        h.disease,
        h.treatment,
        c.tag_no
     FROM health_records h
     JOIN cows c ON h.cow_id = c.id
     WHERE h.user_id = '$user_id'
     ORDER BY h.record_date DESC"
);

include "includes/header.php";
?>

<h3 class="mb-3">Health Records</h3>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Cow Tag</th>
            <th>Disease</th>
            <th>Treatment Given</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?php echo htmlspecialchars($row['tag_no']); ?></td>
            <td><?php echo htmlspecialchars($row['disease']); ?></td>
            <td><?php echo nl2br(htmlspecialchars($row['treatment'])); ?></td>
            <td><?php echo $row['record_date']; ?></td>
        </tr>
    <?php } ?>
    </tbody>
</table>

<a href="dashboard.php" class="btn btn-secondary mt-3">Back to Dashboard</a>

<?php include "includes/footer.php"; ?>
