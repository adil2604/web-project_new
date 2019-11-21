<?php
if (isset($_POST['data'])){
    $user_id=$_COOKIE['id'];
    $id=$_POST['data'];
    $link = mysqli_connect("localhost", "adil", "221634adil", "test");
    $query=mysqli_query($link,"SELECT * FROM `tasks` WHERE user_id=$user_id AND id=$id");
    echo json_encode(mysqli_fetch_array($query));
}



if(isset($_POST['done'])){
    $id=$_POST['done'];
    $code=1;
    if($_POST['code']=='1'){
        $code=0;
    }
    $user_id=$_COOKIE['id'];
    $link = mysqli_connect("localhost", "adil", "221634adil", "test");
    $query=mysqli_query($link,"UPDATE `tasks` SET `done` = $code WHERE `tasks`.`user_id` = $user_id AND id=$id ");
}

