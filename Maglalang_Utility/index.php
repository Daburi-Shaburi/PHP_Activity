<?php
session_start();

$error = "";

// Initialize variables so they exist on first load
$studentID = $name = $section = $subject = $midtermGrade = $finalsGrade = "";

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Get form values
    $studentID     = trim($_POST['studentID'] ?? '');
    $name          = trim($_POST['name'] ?? '');
    $section       = trim($_POST['section'] ?? '');
    $subject       = trim($_POST['subject'] ?? '');
    $midtermGrade  = $_POST['midterm_grade'] ?? '';
    $finalsGrade   = $_POST['finals_grade'] ?? '';

    // Check for empty fields (0 is allowed)
    if (
        $studentID === '' ||
        $name === '' ||
        $section === '' ||
        $subject === '' ||
        $midtermGrade === '' ||
        $finalsGrade === ''
    ) {
        $error = "All fields are required.";
    }
    // Validate student ID
    elseif (!is_numeric($studentID)) {
        $error = "Must be a valid student ID.";
    }
    // Validate grades
    elseif (
        $midtermGrade < 0 || $midtermGrade > 4 ||
        $finalsGrade < 0 || $finalsGrade > 4
    ) {
        $error = "Grades must be between 0 and 4.";
    }

    // If no errors, store data and redirect
    if ($error === '') {
        $_SESSION['studentID']    = $studentID;
        $_SESSION['name']         = $name;
        $_SESSION['section']      = $section;
        $_SESSION['subject']      = $subject;
        $_SESSION['midtermGrade'] = $midtermGrade;
        $_SESSION['finalsGrade']  = $finalsGrade;

        header("Location: dashboard.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registration</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <h1>REGISTRATION</h1>
</header>

<?php if ($error): ?>
    <p style="color:red;"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<form method="POST">

    Student ID:
    <input type="text" name="studentID"
           value="<?= htmlspecialchars($studentID) ?>">
    <hr>

    Name:
    <input type="text" name="name"
           value="<?= htmlspecialchars($name) ?>">
    <hr>

    Section:
    <select name="section">
        <option value="" disabled <?= $section === '' ? 'selected' : '' ?>>Section</option>
        <?php
        $sections = ['IT241','IT242','IT243','IT244','IT245','IT246'];
        foreach ($sections as $s) {
            $selected = ($section === $s) ? 'selected' : '';
            echo "<option value=\"$s\" $selected>$s</option>";
        }
        ?>
    </select>
    <hr>

    Subject:
    <select name="subject">
        <option value="" disabled <?= $subject === '' ? 'selected' : '' ?>>Select a Subject</option>
        <?php
        $subjects = ['WEBPROG','MOBPROG','PEMBEDS','DATAMA','CLOUDCOMP','PEDUTRI','ELECTIVES1'];
        foreach ($subjects as $sub) {
            $selected = ($subject === $sub) ? 'selected' : '';
            echo "<option value=\"$sub\" $selected>$sub</option>";
        }
        ?>
    </select>
    <hr>

    Midterm Grade:
    <input type="number" name="midterm_grade"
           value="<?= htmlspecialchars($midtermGrade) ?>"
           min="0" max="4" step="0.1" required>
    <hr>

    Finals Grade:
    <input type="number" name="finals_grade"
           value="<?= htmlspecialchars($finalsGrade) ?>"
           min="0" max="4" step="0.1" required>
    <hr>

    <input type="submit" value="Submit">

</form>

</body>
</html>