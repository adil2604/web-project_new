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

if (isset($_POST['search'])){
    $link = mysqli_connect("localhost", "adil", "221634adil", "test");
    $title=$_POST['search'];
    $query=mysqli_query($link,"SELECT * FROM `tasks`  WHERE task LIKE $title");
    if(mysqli_num_rows($query)>0){
        echo json_encode(mysqli_fetch_all($query));
    }
    else{
        echo ['nothing'];
    }


}

if (isset($_POST['tab'])){
    $tab=$_POST['tab'];
    switch ($tab){
        case "important": $title="Important tasks";$count=10;
        pagination(10,0);
        $tasks=set_tasks($data,$count);
        echo "<div id=$tab class='index showing'><div class=\"info\"><div class=\"title\">$title</div></div><div class=\"tasks\">$tasks</div></div>";
        break;
        case "today":$title="Today tasks";$count=10;
            pagination(10,1);
            $tasks=set_tasks($data,$count);
            echo "<div id=$tab class='index showing'><div class=\"info\"><div class=\"title\">$title</div></div><div class=\"tasks\">$tasks</div></div>";
            break;
        case 'planned':$title="Planned tasks";$count=10;
            pagination(10,2);
            $tasks=set_tasks($data,$count);
            echo "<div id=$tab class='index showing'><div class=\"info\"><div class=\"title\">$title</div></div><div class=\"tasks\">$tasks</div></div>";
            break;
        default:break;

    }
}



function set_tasks($tasks,$cnt){
    $data='';
    while (($rows = mysqli_fetch_assoc($tasks)) && ($cnt > 0)) {
        $class='check';
        $btn='';
        if($rows['done']=="1"){
            $class=$class." done";
            $btn="completed";
        }


        $data.="<div class='task'><div class='$class'  id='check".$rows['id']."' onclick='done(".$rows['id'].")'></div><button type='button' class='$btn' id=".$rows['id']." onclick='resize(" . $rows['id'] . ")'>" . $rows['task'] . "</button></div>";
        $cnt--;
    }
    for ($i = 0; $i < $cnt; $i++) {
        $data.="<div class='task'><input type='text' class='addTask' name='' value=''></div>";
    }
    return $data;
}

function pagination($c, $type){
    global $link,$data,$total_pages,$pageno;
    $link = mysqli_connect("localhost", "adil", "221634adil", "test");

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