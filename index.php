<?php
session_start();
require_once 'database.php';

// Fetch all habits
$stmt = $pdo->query("SELECT * FROM daily_habits ORDER BY log_date DESC, created_at DESC");
$habits = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daily Habit Tracker</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="dashboard-container">
        <!-- Add Habit Form -->
        <div class="glass-card">
            <h2 class="header-title">Log Habit</h2>
            <p class="header-val">Track your daily progress</p>

            <?php if (isset($_SESSION['success'])): ?>
                <div class="alert alert-success">
                    <?php 
                        echo $_SESSION['success']; 
                        unset($_SESSION['success']);
                    ?>
                </div>
            <?php endif; ?>

            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-error">
                    <?php 
                        echo $_SESSION['error']; 
                        unset($_SESSION['error']);
                    ?>
                </div>
            <?php endif; ?>

            <form action="details_entry.php" method="POST">
                <div class="form-group">
                    <label for="habit_name">Habit Name</label>
                    <input type="text" id="habit_name" name="habit_name" class="form-control" required placeholder="e.g. Morning Run, Read 10 Pages">
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="log_date">Date</label>
                        <input type="date" id="log_date" name="log_date" class="form-control" required value="<?php echo date('Y-m-d'); ?>">
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select id="status" name="status" class="form-control" required>
                            <option value="Completed">Completed</option>
                            <option value="Missed">Missed</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="notes">Notes (Optional)</label>
                    <input type="text" id="notes" name="notes" class="form-control" placeholder="Any reflections?">
                </div>

                <button type="submit" name="save_habit" class="btn-submit">Save Log</button>
            </form>
        </div>

        <!-- Habits List -->
        <div class="glass-card table-section">
            <h2 class="header-title">Your Progress</h2>
            <p class="header-val">Recent entries</p>

            <div class="table-responsive">
                <?php if ($habits && count($habits) > 0): ?>
                    <table>
                        <thead>
                            <tr>
                                <th>Habit</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Notes</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($habits as $row): ?>
                                <tr>
                                    <td><strong><?php echo htmlspecialchars($row['habit_name']); ?></strong></td>
                                    <td><?php echo date('M d, Y', strtotime($row['log_date'])); ?></td>
                                    <td>
                                        <span class="badge <?php echo $row['status'] == 'Completed' ? 'badge-completed' : 'badge-missed'; ?>">
                                            <?php echo htmlspecialchars($row['status']); ?>
                                        </span>
                                    </td>
                                    <td><?php echo htmlspecialchars($row['notes']); ?></td>
                                    <td>
                                        <a href="delete_habit.php?id=<?php echo $row['id']; ?>" class="delete-btn" onclick="return confirm('Are you sure you want to delete this log?');">Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <div class="empty-state">
                        <p>No habits logged yet. Start crushing your goals today! 🚀</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>
