<?php
session_start();
require_once 'database.php';

if (isset($_POST['save_habit'])) {
    
    $habit_name = $_POST['habit_name'];
    $log_date = $_POST['log_date'];
    $status = $_POST['status'];
    $notes = $_POST['notes'];

    $stmt = $pdo->prepare("INSERT INTO daily_habits (habit_name, log_date, status, notes) VALUES (?, ?, ?, ?)");

    if ($stmt->execute([$habit_name, $log_date, $status, $notes])) {
        $_SESSION['success'] = "Awesome! Habit logged successfully.";
    } else {
        $_SESSION['error'] = "Error logging habit.";
    }
    
    // Redirect back to dashboard
    header("Location: index.php");
    exit();
} else {
    // If someone accesses this file directly, redirect them
    header("Location: index.php");
    exit();
}
?>