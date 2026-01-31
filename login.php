<?php
session_start();
include "includes/db.php";

if (isset($_SESSION['user'])) {
    header("Location: dashboard.php");
    exit();
}

if (isset($_POST['login'])) {
    $email = safe($_POST['email']);
    $password = md5($_POST['password']);

    $query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $_SESSION['user'] = mysqli_fetch_assoc($result);
        session_regenerate_id(true);
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Invalid email or password";
    }
}

include "includes/header.php";
?>

<div class="row justify-content-center">
    <div class="col-md-5">
        <div class="card shadow-sm mt-5">
            <div class="card-body">
                <h3 class="text-center mb-4">Login</h3>

                <?php if (isset($error)) { ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php } ?>

                <form method="post">
                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                    <button class="btn btn-primary w-100" name="login">
                        Login
                    </button>
                </form>

                <div class="text-center mt-3">
                    <a href="register.php">New user? Register here</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "includes/footer.php"; ?>
