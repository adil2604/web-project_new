<?php
// Скрипт проверки

// Соединямся с БД
$link=mysqli_connect("localhost", "adil", "221634adil", "test");
echo $_COOKIE['hash']."<br>";

if (isset($_COOKIE['id']) and isset($_COOKIE['hash']))
{
    $query = mysqli_query($link, "SELECT * FROM user WHERE user_id = '".intval($_COOKIE['id'])."' LIMIT 1");
    $userdata = mysqli_fetch_assoc($query);
    echo $userdata['user_hash']."   " ;
    if(($userdata['user_hash'] !== $_COOKIE['hash']) or ($userdata['user_id'] !== $_COOKIE['id']))
    {

        print "Хм, что-то не получилось";
    }
    else
    {   setcookie("id", $_COOKIE['id'], time()+60*60*24*30,"/");
        setcookie("hash", $_COOKIE['hash'], time() +3600*24*30*12, "/");
        header("Location: /home/index.php");
    }
}
else
{
    print "Включите куки";
}
?>
