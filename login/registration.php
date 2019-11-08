<!DOCTYPE html>
<?php  ?>
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
          User Login
        </div>
        <?php
        $link=mysqli_connect("localhost", "adil", "221634adil", "test");

        if(isset($_POST['submit']))
        {
          echo "sss";
            $err = [];

            // проверям логин
            if(!preg_match("/^[a-zA-Z0-9]+$/",$_POST['login']))
            {
                $err[] = "Логин может состоять только из букв английского алфавита и цифр";
            }

            if(strlen($_POST['login']) < 3 or strlen($_POST['login']) > 30)
            {
                $err[] = "Логин должен быть не меньше 3-х символов и не больше 30";
            }

            // проверяем, не сущестует ли пользователя с таким именем
            $query = mysqli_query($link, "SELECT user_id FROM user WHERE user_login='".mysqli_real_escape_string($link, $_POST['login'])."'");
            if(mysqli_num_rows($query) > 0)
            {
                $err[] = "Пользователь с таким логином уже существует в базе данных";
            }

            // Если нет ошибок, то добавляем в БД нового пользователя
            if(count($err) == 0)
            {

                $login = $_POST['login'];

                // Убераем лишние пробелы и делаем двойное хеширование
                $password = md5(md5(trim($_POST['password'])));

                mysqli_query($link,"INSERT INTO user SET user_login='".$login."', user_password='".$password."'");
                header("Location: login.php"); exit();
            }
            else
            {
                print "<b>При регистрации произошли следующие ошибки:</b><br>";
                foreach($err AS $error)
                {
                    print $error."<br>";
                }
            }
        }
         ?>
        <form class="form-login" action="" method="POST">
          <input type="text" name="login" value="" placeholder="Username">
          <input type="password" name="password" value="" placeholder="Password">
          <input type="email" name="email" value="" placeholder="Email">
          <input type="submit" name="submit" value="Register" style="background:#0078D7; color: white;">


        </form>
        Have account? <a href="login.php">Log In</a>
      </div>
    </div>
  </body>
</html>
