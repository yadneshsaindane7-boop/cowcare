<?php
session_start();
include "includes/db.php";

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user']['id'];

// Default milk price per liter
$milk_price = 40;

// Allow user to change milk price
if (isset($_POST['set_price'])) {
    $milk_price = (float) $_POST['milk_price'];
}

$milk = mysqli_fetch_assoc(mysqli_query(
    $conn,
    "SELECT SUM(milk_liters) AS total FROM milk_records WHERE user_id='$user_id'"
));

$feed = mysqli_fetch_assoc(mysqli_query(
    $conn,
    "SELECT SUM(cost) AS total FROM feed_records WHERE user_id='$user_id'"
));

$expense = mysqli_fetch_assoc(mysqli_query(
    $conn,
    "SELECT SUM(amount) AS total FROM expenses WHERE user_id='$user_id'"
));

$total_milk = $milk['total'] ?? 0;
$income = $total_milk * $milk_price;
$total_expense = ($feed['total'] ?? 0) + ($expense['total'] ?? 0);
$profit = $income - $total_expense;

include "includes/header.php";
?>

<h3 class="mb-4">Profit / Loss Report</h3>

<form method="post" class="card p-3 mb-4 shadow-sm" style="max-width:400px;">
    <label class="form-label">Milk Price (₹ per liter)</label>
    <input type="number" step="0.01" name="milk_price" class="form-control mb-2"
           value="<?php echo $milk_price; ?>" required>
    <button class="btn btn-secondary btn-sm" name="set_price">
        Update Price
    </button>
</form>

<table class="table table-bordered">
    <tr>
        <th>Total Milk (Liters)</th>
        <td><?php echo number_format($total_milk, 2); ?></td>
    </tr>
    <tr>
        <th>Milk Price (₹ / Liter)</th>
        <td>₹ <?php echo number_format($milk_price, 2); ?></td>
    </tr>
    <tr>
        <th>Total Income</th>
        <td>₹ <?php echo number_format($income, 2); ?></td>
    </tr>
    <tr>
        <th>Total Expenses</th>
        <td>₹ <?php echo number_format($total_expense, 2); ?></td>
    </tr>
    <tr>
        <th>Net Result</th>
        <td>
            <strong>
                <?php
                echo ($profit >= 0)
                    ? "Profit ₹ " . number_format($profit, 2)
                    : "Loss ₹ " . number_format(abs($profit), 2);
                ?>
            </strong>
        </td>
    </tr>
</table>

<?php include "includes/footer.php"; ?>
