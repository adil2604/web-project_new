<?php
$link = mysqli_connect("localhost", "adil", "221634adil", "test");

if (isset($_POST['get_users'])){
    $query=mysqli_query($link,'SELECT * FROM user');
    echo json_encode(mysqli_fetch_all($query));
}