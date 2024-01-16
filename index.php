<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IT Course</title>
</head>
<body>
    <header>
        <div>
            <img src="assets/logo.png" alt="logo">
            <div>
                Name
            </div>
        </div>
            <?php
                if (isset($_SESSION["user_key"])) {
                        
                    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

                    $mysqli = new mysqli();
                    $mysqli->options(MYSQLI_OPT_INT_AND_FLOAT_NATIVE, 1);
                    $mysqli->real_connect("localhost", "root", "", "IT_course");
                    $result = $mysqli->query("SELECT id FROM users WHERE user_key = '".$_SESSION["user_key"]."'");
                    $row = $result->fetch_assoc();
                        
                    if (count($row)>1) {
                        header("Location: err_page/ERR_multi_acc.php");
                        die();
                    } elseif (count($row)<1) {
                        $auth = false;
                    }
                    elseif (count($row)===1){
                        $auth = true;
                    }else{
                        header("Location: err_page/ERR_multi_acc.php");
                        die();
                    }
                }else{
                    $auth = false;
                    unset($_SESSION['user_key']);
                }
            ?>
            <ul>
                <li>
                    <a href="pages/course.php">Курсы</a>
                    <?php
                        switch ($auth) {
                            case true:
                                echo "<li><a href='pages/account.php'>Профиль</a></li>";
                                break;
                            
                            case false:
                                echo "<li><a href='page/registration'>Регистрация/Вход</a></li>";
                                break;
                        }
                    ?>
                </li>
            </ul>
    </header>
    <main>
        <advert>
            <div>
                <span>
                    Наши курсы выберают Чемпионы!!
                </span>
            </div>
            <div>
                <span>
                    <a href="pages/registration.php"><h4>Зарегестрируйся уже сегодня</h4></a>
                </span>
            </div>
        </advert>
    </main>
</body>
</html>