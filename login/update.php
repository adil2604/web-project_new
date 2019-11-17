<?php
$link = mysqli_connect("localhost", "adil", "221634adil", "test");
echo $_COOKIE['id'];

if (isset($_COOKIE['id'])){
    if(isset($_POST['pass'])){
        $query = mysqli_query($link, "SELECT * FROM user WHERE user_id = '" . intval($_COOKIE['id']) . "' LIMIT 1");
        $userdata = mysqli_fetch_assoc($query);
        if (md5(md5($_POST['pass']))==$userdata['user_password']){
            $e=mysqli_query($link,"UPDATE user SET user_name='".$_POST['firstname']."', user_surname='".$_POST['surname']."', user_password='".md5(md5($_POST['newpass']))."' WHERE user_id = '" . intval($_COOKIE['id']) . "'");
            echo " pass Successfully updated!";
        }
        else{
            echo "Password is not correct ";
        }
    }
    else{
        $e=mysqli_query($link,"UPDATE user SET user_name='".$_POST['firstname']."', user_surname='".$_POST['surname']."' WHERE user_id = '" . intval($_COOKIE['id']) . "' ");
        echo "Successfully updated!";
        echo $_POST['firstname']." ".$_POST['surname'];

    }

}