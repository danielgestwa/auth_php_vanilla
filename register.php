<?php
    session_start();
    require('src/User.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <div style="width: 50vw; margin: auto; padding: 10rem">
        <h2>Rejestracja:</h2>
        
        <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
            
            <p>Login: </p><input type="text" name="login">
            <p>Password: </p><input type="password" name="password">
            <p>Rola: </p>
            <select name="role">
                <option value="1">Administrator</option>
                <option value="2">User</option>
            </select>

            <input style="display: block; margin: 2rem" type="submit" value="Zarejestruj">

        </form>
        <a href="/login.php">Logowanie</a>

        <?php
            $user = new User();
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if(!empty($_POST['login']) && !empty($_POST['password']) && !empty($_POST['role'])) {
                    if(!$user->register($_POST['login'], $_POST['password'], $_POST['role'])) {
                        echo '<p style="color: red">Taki użytkownik już istnieje!</p>';
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