<?php
session_start();

if (!isset($_SESSION['name'], $_SESSION['section'], $_SESSION['subject'])) {
    header("Location: index.php");
    exit;
}

function h($value) {
    return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
}

$midtermGrade = (float) ($_SESSION['midtermGrade'] ?? 0);
$finalsGrade  = (float) ($_SESSION['finalsGrade'] ?? 0);

$averageGrade = ($midtermGrade + $finalsGrade) / 2;

$passingGrade = 1.0;

$passStatus = ($averageGrade >= $passingGrade) ? 'passed' : 'failed';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
</head>
<body>

<h2>
    Hello <strong><?= h($_SESSION['name']) ?></strong>
    from <strong><?= h($_SESSION['section']) ?></strong>! <br><br>
</h2>

<p>
    Your final grade in <strong><?= h($_SESSION['subject']) ?></strong>
    is <strong><?= number_format($averageGrade, 2) ?></strong>. <br><br>

    This means you have <strong><?= h($passStatus) ?></strong>.
</p>

</body>
</html>


