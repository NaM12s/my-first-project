<?php
require_once '../includes/config.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Handle new account creation
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $type = $_POST['type'] ?? '';
    if ($name && $type) {
        $stmt = $pdo->prepare('INSERT INTO accounts (name, type) VALUES (?, ?)');
        $stmt->execute([$name, $type]);
    }
    header('Location: accounts.php');
    exit;
}

$accounts = $pdo->query('SELECT id, name, type FROM accounts ORDER BY id')->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/style.css">
    <title>Accounts</title>
</head>
<body>
    <h2>Accounts</h2>
    <nav>
        <a href="dashboard.php">Dashboard</a>
    </nav>
    <h3>Add Account</h3>
    <form method="post">
        <label>Name: <input type="text" name="name" required></label><br>
        <label>Type:
            <select name="type" required>
                <option value="asset">Asset</option>
                <option value="liability">Liability</option>
                <option value="income">Income</option>
                <option value="expense">Expense</option>
            </select>
        </label><br>
        <button type="submit">Add</button>
    </form>
    <h3>Existing Accounts</h3>
    <table>
        <tr><th>ID</th><th>Name</th><th>Type</th></tr>
        <?php foreach ($accounts as $acc): ?>
        <tr>
            <td><?php echo $acc['id']; ?></td>
            <td><?php echo htmlspecialchars($acc['name']); ?></td>
            <td><?php echo htmlspecialchars($acc['type']); ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
