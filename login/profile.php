<?php
$link = mysqli_connect("localhost", "adil", "221634adil", "test");
if (isset($_COOKIE['id'])) {
    $query = mysqli_query($link, "SELECT * FROM user WHERE user_id = '" . intval($_COOKIE['id']) . "' LIMIT 1");
    $userdata = mysqli_fetch_assoc($query);
    $username=$userdata['user_login'];
}

// Check if $uploadOk is set to 0 by an error



?>


<html lang="">
<head>
    <title><?php echo $username;?> profile's</title>
    <link rel="icon" href="../asserts/icons/icon.png">
    <link href="profile.css" rel="stylesheet">
</head>
<body>
<?php
include '../asserts/templates/navbar.php';
if (isset($_GET['logout'])) {
    setcookie('id', '', time() - 3600 * 24 * 24 * 60, "/");
    setcookie('hash', '', time() - 3600 * 24 * 24 * 60, "/");
    header("Location: ../index.php");

}
?>
<section class="content">
    <div class="profile-box">
        <div class="main">
            <?php


            ?>
            <div class="image" <?php if ($userdata['image_path'] == '') {echo "style='background-image: url(\"../asserts/images/proflie.png\");'";} ?>>
                <?php if ($userdata['image_path'] != '') {
                    echo "<img style='max-width:100%;max-height:100%;width:auto;height:auto;margin:auto;' src='" . $userdata['image_path'] . "' alt='profile photo'>";
                    echo "<form method='post'  action='loadFile.php' enctype=\"multipart/form-data\" >";
                    echo "<div class=\"upload-btn-wrapper uploaded\">  <button class=\"btn\">Upload a file</button><input type=\"file\" name='userfile' onchange=\"this.form.submit()\" /></div>";
                    echo "</form>";
                } else {
                    echo "<form method='post'  action='loadFile.php' enctype=\"multipart/form-data\" >";
                    echo "<div class=\"upload-btn-wrapper uploaded \">  <button class=\"btn\">Upload a file</button><input type=\"file\" name='userfile' onchange=\"this.form.submit()\" /></div>";
                    echo "</form>";

                }



                ?>
            </div>
            <div class="info">
                <div class="email"><div>Email: </div>
                    <?php echo "<section >".$userdata['user_email']."</section>"?></div>
                <div class="email"><div>First Name:</div>
                    <input id='name' type='text' value="<?php echo $userdata['user_name']?>"> </div>
                <div class="email"><div>Surname:</div>
                    <input id='surname' value="<?php echo $userdata['user_surname']?>" type='text'></div>
                <div class="email"><div>Change password:</div>  <section class="pass"><input type="text" id="pass" placeholder="current password"><br><input type="text" id="newPass" placeholder="new password"></section></div>
                <button type="button" id="save"  onclick="save()">Save</button>
                <a href="?logout=1">Log Out</a>
                <?php
                if ($userdata['admin'])
                    echo " <a href='../admin'>Admin panel</a>"
                ?>
                <div id="error" class="error"></div>

            </div>
        </div>
        <div class="tasks">

        </div>
    </div>
</section>
<script src="update_profile.js"></script>
</body>
</html>




