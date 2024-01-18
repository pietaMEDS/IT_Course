<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IT Course</title>
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
    <header>
        <div>
            <img src="assets/logo.png" alt="logo">
            <div>
                ЛУЧШИЙ САЙТ
            </div>
        </div>
            <?php
            session_start();
                if (isset($_SESSION["user_key"])) {
                        
                    require("modules/DB_connect.php");
                    $result = $mysqli->query("SELECT id FROM users WHERE user_key = '".$_SESSION["user_key"]."'");
                    $row = $result->fetch_assoc();
                    if(isset($row)){
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
                    }
                }else{
                    $auth = false;
                    unset($_SESSION['user_key']);
                }
            ?>
            <ul>
                <li>
                    <a href="pages/courses/index.php">Курсы</a>
                    <?php
                        switch ($auth) {
                            case true:
                                echo "<li><a href='pages/account.php'>Профиль</a></li>";
                                break;
                            
                            case false:
                                echo "<li><a href='pages/registration.php'>Регистрация/Вход</a></li>";
                                break;
                        }
                    ?>
                </li>
            </ul>
    </header>
    <main>
    <advert>
        <div   >
<!--            style=" background-color: rgba(77, 179, 255, 0.33);"-->
                <span style="color: #ffffff;  font-weight: 900;  font-size: 70px; letter-spacing: .3rem;  ">
                    НАШИ КУРСЫ ВЫБИРАЮТ ЧЕМПИОНЫ
                </span>
        </div>
<!--        АААА КАРУСЕЛЬ                                                                        -->

        <div id="carousel-container">
            <div id="carousel-wrapper">
                <img src="assets/1.png" alt="Image 1">
                <img src="assets/2.png"  alt="Image 2">
                <img src="assets/1.png" alt="Image 3">
                <img src="assets/2.png" alt="Image 4">
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {
                var carouselWrapper = $("#carousel-wrapper");
                var carouselImages = carouselWrapper.find("img");
                var imageWidth = carouselImages.first().width();
                var currentIndex = 0;

                function moveCarousel() {
                    carouselWrapper.css("transform", "translateX(" + (-imageWidth * currentIndex) + "px)");
                }

                function nextImage() {
                    currentIndex = (currentIndex + 1) % carouselImages.length;
                    moveCarousel();
                }

                function prevImage() {
                    currentIndex = (currentIndex - 1 + carouselImages.length) % carouselImages.length;
                    moveCarousel();
                }

                setInterval(nextImage, 4000);

                $("#carousel-container").on("swipeleft", function() {
                    nextImage();
                });

                $("#carousel-container").on("swiperight", function() {
                    prevImage();
                });
            });
        </script>

        <!--        аааааа конецъ                                                           -->

        <div class="block">
            <h2 style="color: #ffffff;  font-weight: 900;  font-size: 30px; letter-spacing: .3rem;  ">NAME — ЛИЦЕНЗИРОВАННАЯ ШКОЛА И ЛИДЕР В ОБУЧЕНИИ IT-СПЕЦИАЛИСТОВ</h2>
            <div class="grid-container">
                <div class="header-grid-item">
                    <h3>n+ курсов</h3>
                </div>
                <div class="header-grid-item">
                    <h3>n тысяч человек записались на наши курсы</h3>
                </div>
                <div class="header-grid-item">
                    <h3>№ 1 IT-школа количеству студентов</h3>
                </div>

            </div>
        </div>

        <div style="background-color: rgb(128,128,255); border-radius: 30px; padding: 1px; margin: 120px; ">
            <h2  style="color: #ffffff;  font-weight: 900;  font-size: 30px; letter-spacing: .3rem; ">НАЧНИ СЕЙЧАС</h2>
            <p style="color: #ffffff;  font-size: 20px;  text-decoration: none; ">IT-технологии доступны каждому — мы научим создавать веб-сайты, разрабатывать мобильные приложения, освоить основы анализа данных и информационной безопасности. Сможешь заниматься тем, что нравится, и получать высокую заработную плату. Присоединяйся к Name и стань экспертом в сфере IT!</p>
                <span >
                    <a   style="text-decoration: none; color: black;" href="pages/registration.php"><h4 style="background-color: #ffffff; width: max-content; margin-left: 36%; padding: 10px; border-radius: 20px; text-decoration: none; ">Зарегестрируйся уже сегодня</h4></a>
                </span>
        </div>
    </advert>
    </main>
</body>
</html>