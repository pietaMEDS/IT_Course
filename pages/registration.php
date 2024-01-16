<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
                <label for="form_name">Ваше имя</label>
                <input required type="text" name="form_name">
            </div>
            <div>
                <label for="form_tel">Ваш номер телефона</label>
                <input required type="tel" name="form_tel">
            </div>
            <div>
                <label for="form_mail">Ваш Email</label>
                <input required type="email" name="form_mail">
            </div>
            <div>
                <label for="form_password">Ваш пароль</label>
                <input required type="text" name="form_password">
            </div>
            <div>
                <label for="form_password_ret">Повторите пароль</label>
                <input required type="text" name="form_password_ret">
            </div>
            <div>
                <input type="submit">
        </form>
        <div>
            <a href="login.php">У меня уже есть аккаунт!</a>
        </div>
    </main>
    <div class="warning">
        <?php
            //validate
            if ($_GET) {
                require '../modules/DB_connect.php';
                $result = $mysqli->query("SELECT id FROM users WHERE login = '".$_GET["form_login"]."'");
                $row = $result->fetch_assoc();
                if ($row) {
                    echo "<div>Данный логин уже зарегестрирован!</div>";
                }else{
                    $result = $mysqli->query("SELECT id FROM users WHERE email = '".$_GET["form_mail"]."'");
                    $row = $result->fetch_assoc();
                    if ($row) {
                        echo "<div>Данный email уже зарегестрирован!</div>";
                    }else{
                        if ($_GET["form_password"]!=$_GET["form_password_ret"]) {
                            echo "<div>Пароли не соответствуют друг другу!</div>";
                        }else{
                            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                            $charactersLength = strlen($characters);
                            $randomString = '';
                            do{
                                for ($i = 0; $i < 11; $i++) {
                                    $randomString .= $characters[random_int(0, $charactersLength - 1)];
                                }
                                $result = $mysqli->query("SELECT user_key FROM users WHERE user_key = '".$randomString."'");
                                $row = $result->fetch_assoc();
                            }while($row["user_key"] == $randomString);
                            
                            $result = $mysqli->query('INSERT INTO users(login, password, role, name, email, number, user_key) VALUES ( "'.$_GET["form_login"].'" , "'.password_hash($_GET["form_password"],PASSWORD_DEFAULT).'" , "user" , "'.$_GET["form_name"].'" , "'.$_GET["form_mail"].'" , "'.$_GET["form_tel"].'" , "'.$randomString.'")');

                            session_start();
                            $_SESSION["user_key"] = $randomString;
                            echo $_SESSION["user_key"];
                            header("Location: ../index.php");
                        }
                    }
                }
            }
        ?>
    </div>
</body>
</html>