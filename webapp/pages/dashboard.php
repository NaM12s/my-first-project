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
    <title>Dashboard</title>
</head>
<body>
    <h2>Dashboard</h2>
    <nav>
        <a href="accounts.php">Accounts</a> |
        <a href="journal_entries.php">Journal Entries</a> |
        <a href="reports.php">Reports</a> |
        <a href="logout.php">Logout</a>
    </nav>
    <p>Welcome to the accounting dashboard.</p>
</body>
</html>
