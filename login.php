<?php
    session_start();
    require('src/User.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <div style="width: 50vw; margin: auto; padding: 10rem">
        <h2>Login:</h2>
        
        <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
            
            <p>Login: </p><input type="text" name="login">
            <p>Password: </p><input type="password" name="password">
            <input type="submit" style="display: block; margin: 2rem" value="Zaloguj">

        </form>
        <a href="/register.php">Rejestracja</a>

        <?php
            $user = new User();
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if(!empty($_POST['login']) && !empty($_POST['password'])) {
                    if(!$user->login($_POST['login'], $_POST['password'])) {
                        echo '<p style="color: red">Dane nieprawidłowe!</p>';
                    }
                }
                else {
                    echo '<p style="color: red">Uzupełnij wszystkie pola!</p>';
                }
            }
        ?>
    </div>
</body>
</html>