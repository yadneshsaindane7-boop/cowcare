<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CowCare Management</title>
    <!-- Using Bootstrap 5 for responsiveness -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #0d6efd;
        }
        
        body {
            background-color: #f4f7f6;
            overflow-x: hidden;
        }

        /* Responsive Navbar Tweaks */
        .navbar-brand {
            font-size: 1.2rem;
            white-space: nowrap;
        }

        .lang-group {
            display: flex;
            gap: 5px;
        }

        @media (max-width: 576px) {
            .navbar .container {
                flex-direction: column;
                gap: 10px;
                text-align: center;
            }
            .navbar-brand {
                margin-right: 0;
            }
            .navbar .ms-auto {
                margin-left: 0 !important;
                width: 100%;
                justify-content: center;
            }
        }

        /* Translation Progress Bar */
        .translating-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, #ffcc00, #ff6600, #ffcc00);
            background-size: 200% 100%;
            z-index: 10001;
            animation: progressMove 1.5s infinite linear;
        }

        @keyframes progressMove {
            0% { background-position: 200% 0; }
            100% { background-position: -200% 0; }
        }
    </style>
</head>
<body>

<div id="translate-loader" class="translating-overlay"></div>

<nav class="navbar navbar-expand navbar-dark bg-dark mb-3 shadow-sm py-2">
    <div class="container">
        <a class="navbar-brand fw-bold translate-me" href="dashboard.php">🐄 CowCare</a>
        
        <div class="ms-auto d-flex align-items-center gap-2 flex-wrap justify-content-end">
            <div class="btn-group btn-group-sm border border-secondary rounded" role="group">
                <button type="button" id="btn-en" onclick="setLanguage('en')" class="btn btn-dark border-0">English</button>
                <button type="button" id="btn-mr" onclick="setLanguage('mr')" class="btn btn-dark border-0">मराठी</button>
            </div>
            <?php if(isset($_SESSION['user'])): ?>
                <a href="logout.php" class="btn btn-sm btn-danger translate-me">Logout</a>
            <?php endif; ?>
        </div>
    </div>
</nav>

<div class="container px-3 pb-5">