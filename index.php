<?php
    session_start();
    require('src/User.php');

    $user = new User();
    $userData = $user->getUser();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $user->logout();
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>User Data</title>
    </head>
    <body>
        <div style="width: 50vw; margin: auto; padding: 10rem">
            <h2>User data:</h2>
            <ul>
                <li><?=  $userData['login'] ?></li>
                <li><?= ($userData['role'] == 1 ? 'Administrator' : 'User') ?></li>
                <li><?=  $userData['created_at'] ?></li>
            </ul>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
                <input style="display: block; margin-top: 1rem" type="submit" value="Wyloguj się">
            </form>
        </div>
    </body>
</html>