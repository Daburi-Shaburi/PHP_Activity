<?php
session_start();

// Protect the page
if (!isset($_SESSION['name'], $_SESSION['section'], $_SESSION['subject'])) {
    header("Location: index.php");
    exit;
}

// Escape output to prevent XSS
function h($value) {
    return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
}

// Get grades from session
$midtermGrade = (float) ($_SESSION['midtermGrade'] ?? 0);
$finalsGrade  = (float) ($_SESSION['finalsGrade'] ?? 0);

// Calculate average
$averageGrade = ($midtermGrade + $finalsGrade) / 2;

// Passing threshold
$passingGrade = 1.0;

// Determine pass/fail
$passStatus = ($averageGrade >= $passingGrade) ? 'passed' : 'failed';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
</head>
<body>

<h2>Dashboard</h2>

<p>
    Hello <strong><?= h($_SESSION['name']) ?></strong>
    from <strong><?= h($_SESSION['section']) ?></strong>! <br><br>

    Your final grade in <strong><?= h($_SESSION['subject']) ?></strong>
    is <strong><?= number_format($averageGrade, 2) ?></strong>. <br><br>

    This means you have <strong><?= h($passStatus) ?></strong>.
</p>

<a href="logout.php">Logout</a>

</body>
</html>
