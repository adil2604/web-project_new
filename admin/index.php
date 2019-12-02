<?php
$link = mysqli_connect("localhost", "adil", "221634adil", "test");
$user = mysqli_query($link, "SELECT * FROM user WHERE user_id='" . $_COOKIE['id'] . "' LIMIT 1");
$user = mysqli_fetch_assoc($user);
if (!$user['admin']){
    header('Location: /login/login.php?err=not_admin');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title></title>
</head>
<body>
<?php
include '../asserts/templates/navbar.php';
?>
<div class="admin-main">
    <div class="admin-box">

        <table class="tg">
            <tr>
                <th class="tg-8q56">User Name</th>
                <th class="tg-8q56">Role</th>
                <th class="tg-8q56">Date Registration</th>
                <th class="tg-8q56">Tasks</th>
                <th class="tg-8q56">Actions</th>
            </tr>
            <tr>
                <td class="tg-8q56"></td>
                <td class="tg-8q56"></td>
                <td class="tg-8q56"></td>
                <td class="tg-8q56"></td>
                <td class="tg-8q56"></td>
            </tr>

        </table>
    </div>
</div>
<script rel="script" src="scripts.js"></script>
</body>
</html>