<?php
session_start();
require_once 'database.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
    
    $stmt = $pdo->prepare("DELETE FROM daily_habits WHERE id = ?");
    
    if ($stmt->execute([$id])) {
        $_SESSION['success'] = "Habit log deleted.";
    } else {
        $_SESSION['error'] = "Error deleting habit log.";
    }
}

header("Location: index.php");
exit();
?>
