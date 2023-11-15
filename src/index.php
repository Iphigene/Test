<?php
function isPasswordSecure($password) {
    // Password length requirement (at least 8 characters)
    $min_length = 10;

    // Check password length
    if (strlen($password) < $min_length) {
        return false;
    }

    // Password meets the requirements
    return true;
}

function isCommonPassword($password) {
    $commonPasswordsFile = '10-million-password-list-top-1000.txt';

    // Check if the password is in the list
    $commonPasswords = file($commonPasswordsFile, FILE_IGNORE_NEW_LINES);
    return in_array($password, $commonPasswords);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $password = $_POST['password'];

    if (isPasswordSecure($password) && !isCommonPassword($password)) {
        echo <<<HTML
        <!DOCTYPE html>
        <html>
        <head>
            <title>Welcome Page</title>
        </head>
        <body>
            <h1>Welcome page</h1>
            <p>Your password is: $password</p>
            <form action="index.php">
                <input type="submit" value="Logout">
            </form>
        </body>
        </html>
        HTML;
                exit;
    } else {
        echo "Password does not meet security requirements.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
</head>
<body>
    <h1>Welcome to the Login Page</h1>
    <form method="post">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <br><br>
        <input type="submit" value="Login">
    </form>
</body>
</html>
