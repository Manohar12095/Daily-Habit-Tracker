<?php
$db_file = __DIR__ . '/database.sqlite';
try {
    $pdo = new PDO('sqlite:' . $db_file);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $table_sql = "
    CREATE TABLE IF NOT EXISTS daily_habits (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        habit_name TEXT NOT NULL,
        log_date DATE NOT NULL,
        status TEXT NOT NULL DEFAULT 'Completed',
        notes TEXT,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )";
    $pdo->exec($table_sql);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>