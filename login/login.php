<?php
// Страница авторизации
// Функция для генерации случайной строки
function generateCode($length = 6)
{
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHI JKLMNOPRQSTUVWXYZ0123456789";
    $code = "";
    $clen = strlen($chars) - 1;
    while (strlen($code) < $length) {
        $code .= $chars[mt_rand(0, $clen)];
    }
    return $code;
}

// Соединямся с БД
$link = mysqli_connect("localhost", "adil", "221634adil", "test");

if (isset($_POST['submit'])) {
    // Вытаскиваем из БД запись, у которой логин равняеться введенному
    $query = mysqli_query($link, "SELECT user_id, user_password FROM user WHERE user_login='" . mysqli_real_escape_string($link, $_POST['login']) . "' LIMIT 1");
    $data = mysqli_fetch_assoc($query);
    $hash = md5(generateCode(10));
    // Сравниваем пароли
    if ($data['user_password'] === md5(md5($_POST['password']))) {
        // Генерируем случайное число и шифруем его


        // Записываем в БД новый хеш авторизации и IP
        mysqli_query($link, "UPDATE user SET user_hash='" . $hash . "' WHERE user_id='" . $data['user_id'] . "'");

        // Ставим куки
        setcookie("id", $data['user_id'], time() + 60 * 60 * 24 * 30);
        setcookie("hash", $hash, time() + 3600 * 24 * 30 * 12);
        echo $hash;
        // Переадресовываем браузер на страницу проверки нашего скрипта
        header("Location: check.php");
    } else {
        echo "Вы ввели неправильный логин/пароль";
    }
}


?>


<!DOCTYPE html>
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
        <form class="form-login" action="" method="post">
            <input type="text" name="login" value="" placeholder="Username">
            <input type="password" name="password" value="" placeholder="Password">

            <input type="submit" name="submit" value="LOGIN" style="background:#0078D7; color: white;">


        </form>
        Don not have account? <a href="registration.php">Registration</a>
    </div>
</div>
</body>
</html>
