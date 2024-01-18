<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../styles/SignUp.css">
</head>
<body>
    <main>
        <form method="get">
            <!-- id	login	password	role	name	email	number	user_key -->
            <div>
                <label for="form_login">Ваш логин</label>
                <input required type="text" name="form_login" > 
            </div>
            <div>
                <label for="form_password">Ваш пароль</label>
                <input required type="text" name="form_password">
            </div>
            <div>
                <input type="submit">
        </form>
    </main>

    <warning>
        <?php
        error_reporting(0);
            require "../modules/DB_connect.php";
            if (isset($_GET)) {
                $result = $mysqli->query("SELECT password, user_key FROM users WHERE login = '".$_GET["form_login"]."'");
                $row = $result->fetch_assoc();
                if (count($row)<1) {
                    echo "Неправильно введён логин или пароль!";
                }elseif (password_hash($_GET["form_password"],PASSWORD_DEFAULT)===$row["password"]) {
                    session_start();
                    echo "Вы вошли";
                    $_SESSION["user_key"] = $row["user_key"];
                    header("Location: ../index.php");
                }
            }
        ?>
    </warning>
</body>
</html>