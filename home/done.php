<?php
$user_id = $_COOKIE['id'];
$link = mysqli_connect("localhost", "adil", "221634adil", "test");
$user = mysqli_query($link, "SELECT * FROM `user` WHERE user_id=$user_id");
$user = mysqli_fetch_assoc($user);
$count=10;
if (isset($_POST['add'])) {
    $type = $_POST['add'];
    $task = $_POST['task'];
    $date = date('Y-m-d');

    $sql = "INSERT INTO `tasks` (`id`, `user_id`, `task`, `done`, `CreatedAt`, `TodoAt`, `type`, `Description`) VALUES (NULL, $user_id, '$task', '0', '$date' , NULL, $type, NULL)";
    $query = mysqli_query($link, $sql);

}


if (isset($_POST['data'])) {
    $user_id = $_COOKIE['id'];
    $id = $_POST['data'];
    $link = mysqli_connect("localhost", "adil", "221634adil", "test");
    $query = mysqli_query($link, "SELECT * FROM `tasks` WHERE user_id=$user_id AND id=$id");
    echo json_encode(mysqli_fetch_array($query));
}


if (isset($_POST['done'])) {
    $id = $_POST['done'];
    $code = 1;
    if ($_POST['code'] == '1') {
        $code = 0;
    }
    $user_id = $_COOKIE['id'];
    $link = mysqli_connect("localhost", "adil", "221634adil", "test");
    $query = mysqli_query($link, "UPDATE `tasks` SET `done` = $code WHERE `tasks`.`user_id` = $user_id AND id=$id ");
}

if (isset($_POST['search'])) {
    $link = mysqli_connect("localhost", "adil", "221634adil", "test");
    $search = $_POST['search'];
    $query = mysqli_query($link, "SELECT * FROM `tasks`  WHERE task LIKE $search");
    if (strlen($search) > 2 && $query) {
        $title = "Search by " . $_POST['search'];
        $count = 10;
        $tasks = set_tasks($query, $count, 0,true);
        echo "<div  class='index showing'><div class=\"info\"><div class=\"title\">$title</div></div><div class=\"tasks\">$tasks</div></div>";
    } else if (strlen($search) > 2 && !$query) {
        echo "<div  class='index showing'><div class=\"info\"><div class=\"title\">Sorry, but nothing found on request $search!</div></div><div class=\"tasks\"></div></div>";
    }


}

if (isset($_POST['tab'])) {
    $tab = $_POST['tab'];
    switch ($tab) {
        case "important":
            $title = "Important tasks";
            $count = 10;
            pagination(10, 0);
            $tasks = set_tasks($data, $count,0);
            echo "<div id=$tab class='index showing'><div class=\"info\"><div class=\"title\">$title</div></div><div class=\"tasks\">$tasks</div></div>";
            break;
        case "today":
            $title = "Today tasks";
            $count = 10;
            pagination(10, 1);
            $tasks = set_tasks($data, $count,1);
            echo "<div id=$tab class='index showing'><div class=\"info\"><div class=\"title\">$title</div></div><div class=\"tasks\">$tasks</div></div>";
            break;
        case 'planned':
            $title = "Planned tasks";
            $count = 10;
            pagination(10, 2);
            $tasks = set_tasks($data, $count,2);
            echo "<div id=$tab class='index showing'><div class=\"info\"><div class=\"title\">$title</div></div><div class=\"tasks\">$tasks</div></div>";
            break;
        default:
            break;

    }
}
if(isset($_POST['page'])){
    $page=$_POST['page'];

}


function set_tasks($tasks, $cnt,$id=0 ,$search = false)
{
    $data = '';
    if(mysqli_num_rows($tasks)>0){
        while (($rows = mysqli_fetch_assoc($tasks)) && ($cnt > 0)) {
            $type = $rows['type'];
            $class = 'check';
            $btn = '';
            if ($rows['done'] == "1") {
                $class = $class . " done";
                $btn = "completed";
            }


            $data .= "<div class='task'><div class='$class'  id='check" . $rows['id'] . "' onclick='done(" . $rows['id'] . ")'></div><button type='button' class='$btn' id=" . $rows['id'] . " onclick='resize(" . $rows['id'] . ")'>" . $rows['task'] . "</button></div>";
            $cnt--;
        }
        if (!$search && $cnt>1) {
            $data .= "<div class='task'><input type='text' class='addTask' id='input$type' placeholder='Add task' onchange='add_task($type)' value=''></div>";
            for ($i = 0; $i < $cnt - 1; $i++) {
                $data .= "<div class='task'><div class='addTask' ></div></div>";
            }
        }
    }
    else{
        if (!$search && $cnt>0) {
            $data .= "<div class='task'><input type='text' class='addTask' id='input$id' placeholder='Add task' onchange='add_task($id)' value=''></div>";
            for ($i = 0; $i < $cnt - 1; $i++) {
                $data .= "<div class='task'><div class='addTask' ></div></div>";
            }
        }
    }


    return $data;
}

function pagination($c, $type)
{
    global $link, $data, $total_pages, $pageno;
    $link = mysqli_connect("localhost", "adil", "221634adil", "test");

    if (isset($_GET['pageno'])) {
        $pageno = $_GET['pageno'];
    } else {
        $pageno = 1;
    }
    $offset = ($pageno - 1) * $c;

    $total_pages_sql = "SELECT COUNT(*) FROM test.tasks WHERE user_id = '" . $_COOKIE['id'] . "' AND Type=" . $type . " ";
    $result = mysqli_query($link, $total_pages_sql);
    $total_rows = mysqli_fetch_array($result)[0];
    $total_pages = ceil($total_rows / $c);
    $data = mysqli_query($link, "SELECT * FROM test.tasks WHERE user_id = '" . $_COOKIE['id'] . "' AND Type=" . $type . " LIMIT $offset, $c");

}

