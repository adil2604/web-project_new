<?php
$user_id = $_COOKIE['id'];
$link = mysqli_connect("localhost", "adil", "221634adil", "test");
$user = mysqli_query($link, "SELECT * FROM `user` WHERE user_id=$user_id");
$user = mysqli_fetch_assoc($user);

$count = 10;
if (isset($_POST['add'])) {
    $type = $_POST['add'];
    $task = $_POST['task'];
    $date = date('Y-m-d');

    $sql = "INSERT INTO `tasks` (`id`, `user_id`, `task`, `done`, `CreatedAt`, `TodoAt`, `type`, `Description`) VALUES (NULL, $user_id, '$task', '0', '$date' , NULL, $type, NULL)";
    $query = mysqli_query($link, $sql);

} else if (isset($_POST['edit'])) {
    $id = $_POST['edit'];
    $query = mysqli_query($link, "SELECT * FROM `tasks` WHERE `id` = $id AND `user_id` = $user_id");
    echo json_encode(mysqli_fetch_array($query));


}

if (isset($_POST['data'])) {
    $user_id = $_COOKIE['id'];
    $id = $_POST['data'];
    $link = mysqli_connect("localhost", "adil", "221634adil", "test");
    $query = mysqli_query($link, "SELECT * FROM `tasks` WHERE user_id=$user_id AND id=$id");
    echo json_encode(mysqli_fetch_array($query));
}
if(isset($_POST['delete'])){
    $id=$_POST['delete'];
    $sql="DELETE FROM `tasks` WHERE `tasks`.`id` = $id";
    $query=mysqli_query($link,$sql);
    echo $query;
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
        $tasks = set_tasks($query, $count, 0, true);
        echo "<div  class='index showing'><div class=\"info\"><div class=\"title\">$title</div></div><div class=\"tasks\">$tasks</div></div>";
    } else if (strlen($search) > 2 && !$query) {
        echo "<div  class='index showing'><div class=\"info\"><div class=\"title\">Sorry, but nothing found on request $search!</div></div><div class=\"tasks\"></div></div>";
    }


}

if (isset($_POST['tab'])) {
    $tab = $_POST['tab'];
    echo setData(0, $tab);
}


if (isset($_POST['count'])) {
    $type = $_POST['count'];
    $query = mysqli_query($link, "SELECT COUNT(*) FROM `tasks`  WHERE user_id='$user_id' AND type='$type'");
    echo json_encode(mysqli_fetch_assoc($query));

}

if (isset($_POST['get'])) {
    $request = $_POST['get'];
    $type = intval($_POST['type']);
    switch ($request) {
        case "pages":
            $total_pages_sql = "SELECT COUNT(*) FROM test.tasks WHERE user_id = '" . $_COOKIE['id'] . "' AND Type=" . $type . " ";
            $result = mysqli_query($link, $total_pages_sql);
            $total_rows = mysqli_fetch_array($result)[0];
            $total_pages = ceil($total_rows / $count);
            echo $total_pages;
            break;
        case "pageno":
            $page = $_POST['pageno'];
            $offset = ($page - 1) * $count;
            switch ($type) {
                case 0:
                    echo setData($offset, 'important');
                    break;
                case 1:
                    echo setData($offset, 'today');
                    break;
                case 2:
                    echo setData($offset, 'planned');
                    break;
            }
            break;
    }

}


function set_tasks($tasks, $cnt, $id = 0, $search = false)
{
    $data = '';
    if (mysqli_num_rows($tasks) > 0) {
        while (($rows = mysqli_fetch_assoc($tasks)) && ($cnt > 0)) {
            $type = $rows['type'];
            $class = 'check';
            $btn = '';
            if ($rows['done'] == "1") {
                $class = $class . " done";
                $btn = "completed";
            }


            $data .= "<div class='task' id='id".$rows['id']."' ><div class='$class'  id='check" . $rows['id'] . "' onclick='done(" . $rows['id'] . ")'></div><button type='button' class='$btn' id=" . $rows['id'] . " onclick='resize(" . $rows['id'] . ")'>" . $rows['task'] . "</button></div>";
            $cnt--;
        }
        if (!$search && $cnt > 1) {
            $data .= "<div class='task'><input type='text' class='addTask add'  id='input$type' placeholder='Add task...' onchange='add_task($type)' value=''></div>";
            for ($i = 0; $i < $cnt - 1; $i++) {
                $data .= "<div class='task'><div class='addTask' ></div></div>";
            }
        }
    } else {
        if (!$search && $cnt > 0) {
            $data .= "<div class='task'><input type='text' class='addTask' id='input$id' placeholder='Add task' onchange='add_task($id)' value=''></div>";
            for ($i = 0; $i < $cnt - 1; $i++) {
                $data .= "<div class='task'><div class='addTask' ></div></div>";
            }
        }
    }


    return $data;
}

function getTasks($offset, $count, $type)
{
    global $link;
    $data = mysqli_query($link, "SELECT * FROM test.tasks WHERE user_id = '" . $_COOKIE['id'] . "' AND Type=" . $type . " LIMIT $offset,$count");
    return $data;
}


function setData($offset, $tab)
{
    global $count;
    $page = ($offset / $count) + 1;
    $page_next = $page + 1;
    $page_prev = $page - 1;

    switch ($tab) {
        case "important":
            $title = "Important tasks";
            $data = getTasks($offset, $count, 0);
            $tasks = set_tasks($data, $count, 0);
            return "<div id=$tab class='index showing'><div class=\"info\"><div class=\"title\">$title</div>
<div class=\"container small\">
  <div class=\"pagination\">
      <ul>
          <li class=\"active\"><a onclick='getPage(0,$page_prev)' href=\"#\"></a></li>       
        <li class=\"active\" ><a onclick = 'getPage(0,$page_next)'href = \"#\" ></a ></li>       
      </ul >
  </div >
</div ></div><div class=\"tasks\">$tasks</div></div>";
            break;
        case "today":
            $title = "Today tasks";
            $data = getTasks($offset, $count, 1);
            $tasks = set_tasks($data, $count, 1);
            return "<div id=$tab class='index showing'><div class=\"info\"><div class=\"title\">$title</div>
<div class=\"container small\">
  <div class=\"pagination\">
      <ul>
          <li class=\"active\"><a onclick='getPage(1,$page_prev)' href=\"#\"></a></li>       
        <li class=\"active\" ><a onclick = 'getPage(1,$page_next)' href = \"#\" ></a></li>       
      </ul>
  </div >
</div ></div><div class=\"tasks\">$tasks</div></div>";
            break;
        case 'planned':
            $title = "Planned tasks";
            $data = getTasks($offset, $count, 2);
            $tasks = set_tasks($data, $count, 2);
            return "<div id=" . $tab . " class='index showing'><div class=\"info\"><div class=\"title\">" . $title . "</div><div class=\"container small\">
  <div class=\"pagination\">
      <ul>
          <li class=\"active\"><a onclick='getPage(2,$page_prev)' href=\"#\"></a></li>       
          <li class=\"active\"><a onclick='getPage(2,$page_next)' href=\"#\"></a></li>       
      </ul>
  </div>
</div>
</div><div class=\"tasks\">" . $tasks . "</div></div>";
            break;
        default:
            break;

    }
}