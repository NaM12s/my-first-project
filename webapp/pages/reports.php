<?php
require_once '../includes/config.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/style.css">
    <title>Reports</title>
</head>
<body>
    <h2>Reports</h2>
    <nav>
        <a href="dashboard.php">Dashboard</a>
    </nav>
    <p>Report generation is under construction.</p>
</body>
</html>
