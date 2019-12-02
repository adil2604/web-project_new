<!DOCTYPE html>
<?php ?>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="login.css">
    <title></title>
</head>
<body>
<div class="login">
    <div class="login-box">
        <div class="name">
            Registration
        </div>
        <?php
        $link = mysqli_connect("localhost", "adil", "221634adil", "test");

        $err = [];
        if (isset($_POST['submit'])) {
            $email=$_POST['email'];
            $login=$_POST['login'];
            $password=$_POST['password'];
            // проверям логин
            if (!preg_match("/^[a-zA-Z0-9]+$/", $login)) {
                array_push($err,'Username must contain only latin letters and numbers!');
            }

            if (strlen($login) < 3 or strlen($login) > 30) {
                array_push($err,'Username must be more than 3 symbols!');
            }

            // проверяем, не сущестует ли пользователя с таким именем
            $query = mysqli_query($link, "SELECT user_id FROM user WHERE user_login='$login'");
            if (mysqli_num_rows($query) > 0) {
                array_push($err,'User with this username exist!');
            }

            $query = mysqli_query($link, "SELECT user_id FROM user WHERE user_email='$email'");
            if (mysqli_num_rows($query) > 0) {
                array_push($err,'User with this email exist!');
            }

            // Если нет ошибок, то добавляем в БД нового пользователя
            if (count($err) == 0) {

                $login = $_POST['login'];

                // Убераем лишние пробелы и делаем двойное хеширование
                $password = md5(md5(trim($_POST['password'])));

                mysqli_query($link, "INSERT INTO user SET user_login='" . $login . "', user_password='" . $password . "'");
                header("Location: login.php");
                exit();
            }
        }
        ?>
        <form class="form-login" action="" method="POST">
            <input type="text" name="login" value=""  required placeholder="Username">
            <input type="email" name="email" value="" required placeholder="Email">
            <input type="password" name="password" required value="" placeholder="Password">
            <input type="submit" name="submit" value="Register" style="background:#0078D7; color: white;">


        </form>
        <?php
        if(isset($err)){
            foreach ($err as $error){
                echo "<div class='err'>$error<br></div>";
            }
        }
        ?>
        Have account? <a href="login.php">Log In</a>
    </div>
</div>
</body>
</html>
