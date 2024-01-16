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
                <input require type="text" name="form_login" <?php if (isset($_GET["form_login"])){ echo 'value="'.$_GET["form_login"].'"';} ?> >
            </div>
            <div>
                <label for="form_name">Ваше имя</label>
                <input require type="text" name="form_login" <?php if (isset($_GET["form_name"])){ echo "value='".$_GET["form_name"]."'";} ?> >
            </div>
            <div>
                <label for="form_tel">Ваш номер телефона</label>
                <input require type="tel" name="form_tel" <?php if (isset($_GET["form_tel"])){ echo "value='".$_GET["form_tel"]."'";} ?> >
            </div>
            <div>
                <label for="form_mail">Ваш Email</label>
                <input require type="email" name="form_mail" <?php if (isset($_GET["form_mail"])){ echo "value='".$_GET["form_mail"]."'";} ?> >
            </div>
            <div>
                <label for="form_password">Ваш пароль</label>
                <input require type="text" name="form_password">
            </div>
            <div>
                <label for="form_password_ret">Повторите пароль</label>
                <input require type="text" name="form_password_ret">
            </div>
            <div>
                <input type="submit">
        </form>
    </main>
    <div class="warning">
        <?php
            //validate
            // if ($_GET["form_login"]) {
            //     # code...
            // }
            if (isset($_GET["form_login"])){ echo 'value="'.$_GET["form_login"].'"';}
            echo $_GET["form_login"];
        ?>
    </div>+
</body>
</html>