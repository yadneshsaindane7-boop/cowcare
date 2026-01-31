<?php
session_start();
include "includes/db.php";

if (isset($_SESSION['user'])) {
    header("Location: dashboard.php");
    exit();
}

if (isset($_POST['register'])) {
    $name = safe($_POST['name']);
    $email = safe($_POST['email']);
    $password = md5($_POST['password']);

    $check = mysqli_query($conn, "SELECT id FROM users WHERE email='$email'");

    if (mysqli_num_rows($check) > 0) {
        $error = "Email already registered";
    } else {
        mysqli_query(
            $conn,
            "INSERT INTO users (name, email, password, role)
             VALUES ('$name', '$email', '$password', 'staff')"
        );
        $success = "Registration successful. You can login now.";
    }
}

include "includes/header.php";
?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm mt-5">
            <div class="card-body">
                <h3 class="text-center mb-4">User Registration</h3>

                <?php if (isset($error)) { ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php } ?>

                <?php if (isset($success)) { ?>
                    <div class="alert alert-success"><?php echo $success; ?></div>
                <?php } ?>

                <form method="post">
                    <div class="mb-3">
                        <label class="form-label">Full Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                    <button class="btn btn-primary w-100" name="register">
                        Register
                    </button>
                </form>

                <div class="text-center mt-3">
                    <a href="login.php">Already have an account? Login</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "includes/footer.php"; ?>
