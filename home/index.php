
<?php
$tab='important';

if (!isset($_COOKIE['id']))
    header("Location: ../login/login.php");

if (isset($_GET['tab'])){
    $tab=$_GET['tab'];
}
$link=mysqli_connect("localhost", "adil", "221634adil", "test");

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
        <form class="search" action="" method="post" style="width: 30%;height: 50%;display:flex;" >
          <input type="text" name="search-input" class="search-input" value="" placeholder="Search in tasks....">
          <input type="button" name=""  id="search"value="" style="border:0; width: 10%;height: 108%; margin:0">
        </form>

        <a href="<?php if (isset($_COOKIE['id'])){echo "../login/profile.php";}else {echo "../login/login.php";}  ?>" class="profile"  style="height: 100%;width: 5%;margin-right: 2vw;"></a>
      </nav>
    </section>
    <section class="content" >
        <section class="tabs">
          <div class="tabs-box" style="width:100%;height:70%;margin:3vw 0 auto auto;display:flex;flex-direction:column;">
            <button type="button" <?php if ($tab=="important"){echo "class='active'"; } ?> name="button" style="background-image: url('../asserts/icons/0.png');" onclick="setActive(0)">Important</button>
            <button type="button" name="button" <?php if ($tab=="today"){echo "class='active'"; } ?> style="background-image: url('../asserts/icons/1.png');" onclick="setActive(1)">Today tasks</button>
            <button type="button" name="button" <?php if ($tab=="planned"){echo "class='active'"; } ?> style="background-image: url('../asserts/icons/2.png');" onclick="setActive(2)">Planned tasks</button>



          </div>
        </section>
        <div class="main-content">
          <div id="important" <?php if ($tab=="important"){echo "class='index showing'"; }
          else{echo "class='index'";}?> >
            <div class="info">
              <div class="">
                Important
                <?php
                $link=mysqli_connect("localhost", "adil", "221634adil", "test");
                if (isset($_GET['pageno'])) {
                    $pageno = $_GET['pageno'];
                } else {
                    $pageno = 1;
                }
                $no_of_records_per_page = 10;
                $offset = ($pageno-1) * $no_of_records_per_page;

                $conn=$link;
                // Check connection
                if (mysqli_connect_errno()){
                    echo "Failed to connect to MySQL: " . mysqli_connect_error();
                    die();
                }

                $total_pages_sql = "SELECT COUNT(*) FROM test.tasks WHERE user_id = '".$_COOKIE['id']."' ";
                $result = mysqli_query($conn,$total_pages_sql);
                $total_rows = mysqli_fetch_array($result)[0];
                $total_pages = ceil($total_rows / $no_of_records_per_page);


                  if (isset($_COOKIE['id'])){
                    echo $_COOKIE['id'] ;
                    $query = mysqli_query($link, "SELECT * FROM test.tasks WHERE user_id = '".$_COOKIE['id']."' AND Type=0 LIMIT $offset, $no_of_records_per_page");
                    echo mysqli_num_rows($query);



                  }
                 ?>
              </div>
            </div>
            <div class="tasks">
              <?php
              $count=10;
              while(($rows=mysqli_fetch_assoc($query))&& ($count>0) ){
                echo "<div class='task'><button type='button'>".$rows['task']."</button></div>";
                $count--;
               }
               for($i=0;$i<$count;$i++){
                 echo "<div class='task'><input type='text' class='addTask' name='' value=''></div>";
               }
               ?>


            </div>
            <ul class="pagination">
                <li><a href="?tab=important&pageno=1">First</a></li>
                <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
                    <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?tab=important&pageno=".($pageno - 1); } ?>">Prev</a>
                </li>
                <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
                    <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?tab=important&pageno=".($pageno + 1); } ?>">Next</a>
                </li>
                <li><a href="?tab=important&pageno=<?php echo $total_pages; ?>">Last</a></li>
            </ul>
          </div>
          <div id="today" <?php if ($tab=="today"){echo "class='index showing'"; }
          else{echo "class='index'";}?>>
            <div class="info">
              <div class="">
                <h2>Today tasks</h2>
              </div>
            </div>
            <div class="tasks">
              <?php
              $link=mysqli_connect("localhost", "adil", "221634adil", "test");

              if (isset($_COOKIE['id'])){
                echo $_COOKIE['id'] ;
              $query = mysqli_query($link, "SELECT * FROM test.tasks WHERE user_id = '".$_COOKIE['id']."' AND Type=1 LIMIT $offset, $no_of_records_per_page");
              echo mysqli_num_rows($query);
            }
              $count=10;
              while(($rows=mysqli_fetch_assoc($query))&& ($count>0) ){
                echo "<div class='task'><button type='button'>".$rows['task']."</button></div>";
                $count--;
               }
               for($i=0;$i<$count;$i++){
                 echo "<div class='task'><input type='text' class='addTask' name='' value=''></div>";
               }
               ?>

            </div>
            <button type="button" name="button" onclick="resize()" >open</button>
            <ul class="pagination">
                <li><a href="?tab=today&pageno=1">First</a></li>
                <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
                    <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?tab=today&pageno=".($pageno - 1); } ?>">Prev</a>
                </li>
                <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
                    <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?tab=today&pageno=".($pageno + 1); } ?>">Next</a>
                </li>
                <li><a href="?tab=today&pageno=<?php echo $total_pages; ?>">Last</a></li>
            </ul>
          </div>
          <div id="planned" <?php if ($tab=="planned"){echo "class='index showing'"; }
          else{echo "class='index'";}?>>
            <div class="info">
              <div class="">
                <h2>Planned tasks</h2>
              </div>
            </div>
            <div class="tasks">
              <div class="task">
                <input type="text" class="addTask" name="" value="">
              </div>
              <div class="task">
                <input type="text" class="addTask" name="" value="">
              </div>
              <div class="task">
                <input type="text" class="addTask" name="" value="">
              </div>
              <div class="task">
                <input type="text" class="addTask" name="" value="">
              </div>

            </div>
          </div>
        </div>
        <div class="edit">

        </div>

    </section>

    <script type="text/javascript" src='index.js'>

    </script>
  </body>
</html>
