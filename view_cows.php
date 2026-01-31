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
    "SELECT * FROM cows WHERE user_id='$user_id' ORDER BY id DESC"
);

include "includes/header.php";
?>

<h3 class="mb-4">My Cows</h3>

<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Tag No</th>
            <th>Breed</th>
            <th>Age</th>
            <th>Health Status</th>
            <th width="180">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo htmlspecialchars($row['tag_no']); ?></td>
                <td><?php echo htmlspecialchars($row['breed']); ?></td>
                <td><?php echo $row['age']; ?></td>
                <td><?php echo htmlspecialchars($row['health_status']); ?></td>
                <td>
                    <a href="edit_cow.php?id=<?php echo $row['id']; ?>" 
                       class="btn btn-sm btn-warning">
                        Edit
                    </a>

                    <a href="delete_cow.php?id=<?php echo $row['id']; ?>" 
                       class="btn btn-sm btn-danger"
                       onclick="return confirm('Are you sure you want to delete this cow?');">
                        Delete
                    </a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<a href="dashboard.php" class="btn btn-secondary mt-3">Back to Dashboard</a>

<?php include "includes/footer.php"; ?>
