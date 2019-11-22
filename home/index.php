<?php
$tab = 'important';

if (!isset($_COOKIE['id']))
    header("Location: ../login/login.php");

if (isset($_GET['tab'])) {
    $tab = $_GET['tab'];
}
$link = mysqli_connect("localhost", "adil", "221634adil", "test");
$user = mysqli_query($link, "SELECT * FROM user WHERE user_id='" . $_COOKIE['id'] . "' LIMIT 1");
$user = mysqli_fetch_assoc($user);
$image_path = $user['image_path'];

$data='';
$total_pages=0;
$pageno=1;
function pagination($c, $type){
    global $link,$data,$total_pages,$pageno;
    if (isset($_GET['pageno'])) {
        $pageno = $_GET['pageno'];
    } else {
        $pageno = 1;
    }
    $offset = ($pageno - 1) * $c;

    $total_pages_sql = "SELECT COUNT(*) FROM test.tasks WHERE user_id = '" . $_COOKIE['id'] . "' AND Type=".$type." ";
    $result = mysqli_query($link, $total_pages_sql);
    $total_rows = mysqli_fetch_array($result)[0];
    $total_pages = ceil($total_rows / $c);
    $data = mysqli_query($link, "SELECT * FROM test.tasks WHERE user_id = '" . $_COOKIE['id'] . "' AND Type=".$type." LIMIT $offset, $c");

}

function set_tasks($tasks,$cnt){
    while (($rows = mysqli_fetch_assoc($tasks)) && ($cnt > 0)) {
        $class='check';
        $btn='';
        if($rows['done']=="1"){
            $class=$class." done";
            $btn="completed";
        }


        echo "<div class='task'><div class='$class'  id='check".$rows['id']."' onclick='done(".$rows['id'].")'></div><button type='button' class='$btn' id=".$rows['id']." onclick='resize(" . $rows['id'] . ")'>" . $rows['task'] . "</button></div>";
        $cnt--;
    }
    for ($i = 0; $i < $cnt; $i++) {
        echo "<div class='task'><input type='text' class='addTask' name='' value=''></div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="index.css">
    <link rel="icon" href="../asserts/icons/icon.png">
    <title></title>
</head>
<body>
<section class='nav'>
    <nav style="width: 100%;height: 100%">
        <img src="../asserts/icons/icon.png" alt="Logo" style="width:auto;height: 100%; margin-left: 2vw;">
        <form class="search" action="" method="post" style="width: 30%;height: 50%;display:flex;">
            <input type="text" name="search-input" class="search-input" value="" id="search-in" onkeyup="search_in()" placeholder="Search in tasks....">
            <input type="button" name="" id="search" value="" style="border:0; width: 10%;height: 108%; margin:0">
        </form>

        <a href="../login/profile.php" class="profile"
           style="background-image: url(<?php echo $image_path; ?>); height: 70%;width: 3%;margin-right: 2vw;"></a>
    </nav>
</section>
<section class="content">
    <section class="tabs">
        <div class="tabs-box" style="width:100%;height:70%;margin:3vw 0 auto auto;display:flex;flex-direction:column;">
            <div   style="background-image: url('../asserts/icons/0.png');" onclick="setActive(0)">Important
            </div>
            <div style="background-image: url('../asserts/icons/1.png');" onclick="setActive(1)">Today tasks
            </div>
            <div style="background-image: url('../asserts/icons/2.png');" onclick="setActive(2)">Planned tasks
            </div>


        </div>
    </section>
    <div class="main-content">

        </div>
    </div>
    <div class="edit">

    </div>

</section>

<script type="text/javascript" src='index.js'>

</script>
</body>
</html>
