<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../styles/style.css">
</head>
<body>
    <header>
        <div>
            <img src="../../assets/logo.png" alt="logo">
            <div>
                ЛУЧШИЕ САЙТ
            </div>
        </div>
            <?php
            session_start();
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
                                echo "<li><a href='pages/registration'>Регистрация/Вход</a></li>";
                                break;
                        }
                    ?>
                </li>
            </ul>
    </header>
    <main id="Course-library">
        <?php
            require '../../modules/DB_connect.php';
            $cours_result = $mysqli->query("SELECT * FROM courses");
            $course_row = $cours_result->fetch_assoc();
            do {
                echo "<div class='course'><img src='../../assets/courses/".$course_row['img']."' alt='course'> <h3>".$course_row['name']." </h3>";
                // $purchase_result = $mysqli->query("SELECT * FROM purchase WHERE course=".$course_row['id']." AND user = ".$_GET['user_key']);
                // $purchase_row = $purchase_result->fetch_assoc();
                // print_r($purchase_row);
                echo "<div class='flex-around'><button onclick='feedback()'>Понравилось</button><button onclick='feedback()'>Не понравилось</button></div>";
                echo "</div>";
            } while ($course_row = $cours_result->fetch_assoc())
        ?>
    </main>
    <script>
        function feedback(){
            alert("Фидбек отправлен!");
        }
    </script>
</body>
</html>