<?php
$link = mysqli_connect("localhost", "adil", "221634adil", "test");

if (isset($_POST['get_users'])){
    $query=mysqli_query($link,"SELECT * FROM `user`");
    echo json_encode(mysqli_fetch_all($query,MYSQLI_ASSOC));
}

if (isset($_POST['count_tasks'])){
    $user_id=$_POST['count_tasks'];
    $sql="SELECT COUNT(*) FROM `tasks` WHERE user_id=$user_id";
    $query=mysqli_query($link,$sql);
    echo json_encode(mysqli_fetch_assoc($query));
}

if (isset($_POST['search'])){
    $username=$_POST['search'];
    $query = mysqli_query($link, "SELECT * FROM `user`  WHERE user_login LIKE '%$username%'");
    echo json_encode(mysqli_fetch_all($query,MYSQLI_ASSOC));

}