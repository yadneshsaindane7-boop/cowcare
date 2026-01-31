<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

include "includes/header.php";
?>

<h2 class="mb-4">About Cow Care System</h2>

<div class="card shadow-sm p-4 mb-4">
    <h4>Introduction</h4>
    <p>
        Cow Care System is a web-based management application designed to help
        dairy farms, gaushalas, and educational institutions efficiently manage
        cows, health records, milk production, feed, expenses, and overall farm performance.
    </p>
</div>

<div class="card shadow-sm p-4 mb-4">
    <h4>Objectives</h4>
    <ul>
        <li>Maintain complete records of cows</li>
        <li>Track health and medical history</li>
        <li>Monitor daily and monthly milk production</li>
        <li>Manage feed usage and expenses</li>
        <li>Calculate profit and loss</li>
    </ul>
</div>

<div class="card shadow-sm p-4 mb-4">
    <h4>Key Features</h4>
    <ul>
        <li>Secure login system with role-based access</li>
        <li>Cow management (Add, View, Delete)</li>
        <li>Health record management</li>
        <li>Milk production tracking and reports</li>
        <li>Feed and expense management</li>
        <li>Profit and loss calculation</li>
        <li>User-friendly interface using Bootstrap</li>
    </ul>
</div>

<div class="card shadow-sm p-4 mb-4">
    <h4>Technology Used</h4>
    <ul>
        <li><strong>Frontend:</strong> HTML, CSS, Bootstrap</li>
        <li><strong>Backend:</strong> PHP</li>
        <li><strong>Database:</strong> MySQL</li>
        <li><strong>Server:</strong> XAMPP (Apache)</li>
    </ul>
</div>

<div class="card shadow-sm p-4 mb-4">
    <h4>Future Enhancements</h4>
    <ul>
        <li>English–Marathi language support</li>
        <li>Staff-level access and permissions</li>
        <li>Advanced analytics and charts</li>
        <li>Mobile-friendly enhancements</li>
    </ul>
</div>

<?php include "includes/footer.php"; ?>
