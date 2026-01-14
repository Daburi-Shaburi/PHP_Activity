<?php
$error = "";

function old($field) {
    return htmlspecialchars($_POST[$field] ?? '');
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $fullname   = trim($_POST['fullname'] ?? '');
    $email      = trim($_POST['email'] ?? '');
    $age        = trim($_POST['age'] ?? '');
    $gender     = $_POST['gender'] ?? '';
    $course     = $_POST['course'] ?? '';
    $contactno  = trim($_POST['contactno'] ?? '');
    $address    = trim($_POST['address'] ?? '');

    if (
        $fullname === "" ||
        $email === "" ||
        $age === "" ||
        $gender === "" ||
        $course === "" ||
        $contactno === ""
    ) {
        $error = "All fields must be filled out.";
    }
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format.";
    }
    else {
        $success = "Form Submitted Successfully!";
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

<?php if (!empty($error)): ?>
    <p style="color:red;"><?php echo htmlspecialchars($error); ?></p>
<?php endif; ?>

<form method="POST">

    Fullname:
    <input type="text" name="fullname" value="<?= old('fullname') ?>">
    <hr>

    Email Address:
    <input type="email" name="email" value="<?= old('email') ?>">
    <hr>

    Age:
    <input type="number" name="age" value="<?= old('age') ?>" min="0">
    <hr>

    Gender:<br>
    <input type="radio" name="gender" value="male"
        <?= (($_POST['gender'] ?? '') === 'male') ? 'checked' : '' ?>> Male<br>

    <input type="radio" name="gender" value="female"
        <?= (($_POST['gender'] ?? '') === 'female') ? 'checked' : '' ?>> Female<br>

    <input type="radio" name="gender" value="other"
        <?= (($_POST['gender'] ?? '') === 'other') ? 'checked' : '' ?>> Other
    <hr>

    Course:
    <select name="course">
        <option value="" disabled selected>Select a Course</option>
        <option value="BSIT" <?= (($_POST['course'] ?? '') === 'BSIT') ? 'selected' : '' ?>>BSIT</option>
        <option value="BSE" <?= (($_POST['course'] ?? '') === 'BSE') ? 'selected' : '' ?>>BSE</option>
        <option value="BSBA" <?= (($_POST['course'] ?? '') === 'BSBA') ? 'selected' : '' ?>>BSBA</option>
        <option value="BSCPE" <?= (($_POST['course'] ?? '') === 'BSCPE') ? 'selected' : '' ?>>BSCPE</option>
    </select>
    <hr>

    Contact Number:
    <input type="number" name="contactno" value="<?= old('contactno') ?>">
    <hr>

    Address:
    <textarea name="address" rows="1"><?= old('address') ?></textarea>
    <hr>

    <input type="submit" value="Submit">

    <?php if (!empty($success)): ?>
    <p style="color:green;"><?php echo htmlspecialchars($success); ?></p>
    <?php endif; ?>

</form>

</body>
</html>