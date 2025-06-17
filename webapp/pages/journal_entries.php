<?php
require_once '../includes/config.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Add new entry
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $debit = $_POST['debit'] ?? 0;
    $credit = $_POST['credit'] ?? 0;
    $account_id = $_POST['account_id'] ?? 0;
    $description = $_POST['description'] ?? '';

    if ($account_id && ($debit || $credit)) {
        $stmt = $pdo->prepare('INSERT INTO journal_entries (account_id, debit, credit, description, entry_date) VALUES (?, ?, ?, ?, NOW())');
        $stmt->execute([$account_id, $debit, $credit, $description]);
    }
    header('Location: journal_entries.php');
    exit;
}

$entries = $pdo->query('SELECT je.id, je.entry_date, a.name, je.debit, je.credit, je.description FROM journal_entries je JOIN accounts a ON je.account_id = a.id ORDER BY je.entry_date DESC')->fetchAll();
$accounts = $pdo->query('SELECT id, name FROM accounts ORDER BY name')->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/style.css">
    <title>Journal Entries</title>
</head>
<body>
    <h2>Journal Entries</h2>
    <nav>
        <a href="dashboard.php">Dashboard</a>
    </nav>
    <h3>Add Entry</h3>
    <form method="post">
        <label>Account:
            <select name="account_id" required>
                <?php foreach ($accounts as $acc): ?>
                    <option value="<?php echo $acc['id']; ?>"><?php echo htmlspecialchars($acc['name']); ?></option>
                <?php endforeach; ?>
            </select>
        </label><br>
        <label>Debit: <input type="number" step="0.01" name="debit"></label><br>
        <label>Credit: <input type="number" step="0.01" name="credit"></label><br>
        <label>Description: <input type="text" name="description"></label><br>
        <button type="submit">Add</button>
    </form>
    <h3>Previous Entries</h3>
    <table>
        <tr><th>Date</th><th>Account</th><th>Debit</th><th>Credit</th><th>Description</th></tr>
        <?php foreach ($entries as $e): ?>
        <tr>
            <td><?php echo $e['entry_date']; ?></td>
            <td><?php echo htmlspecialchars($e['name']); ?></td>
            <td><?php echo $e['debit']; ?></td>
            <td><?php echo $e['credit']; ?></td>
            <td><?php echo htmlspecialchars($e['description']); ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
