<?php

if ($_SERVER['HTTP_HOST'] === 'localhost') {

    // LOCALHOST (XAMPP)
    $conn = mysqli_connect(
        "localhost",
        "root",
        "",
        "cowcare"
    );

} else {

    // LIVE SERVER (InfinityFree)
    $conn = mysqli_connect(
        "sql206.infinityfree.com",
        "if0_40920724",
        "0208naruto",
        "if0_40920724_cowcare"
    );
}

if (!$conn) {
    die("Database connection failed");
}

function safe($data) {
    global $conn;
    return mysqli_real_escape_string($conn, trim($data));
}

