<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
require 'db.php';
$stmt = $pdo->prepare("SELECT courses.title FROM enrollments 
    JOIN courses ON enrollments.course_id = courses.id 
    WHERE enrollments.student_id = ?");
$stmt->execute([$_SESSION['user_id']]);
$courses = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html>
<head><title>Dashboard</title></head>
<body>
    <h2>Welcome, <?= htmlspecialchars($_SESSION['name']) ?>!</h2>
    <a href="logout.php">Logout</a>
    <h3>Your Courses:</h3>
    <ul>
        <?php foreach ($courses as $course): ?>
            <li><?= htmlspecialchars($course['title']) ?></li>
        <?php endforeach; ?>
    </ul>
</body>
</html>