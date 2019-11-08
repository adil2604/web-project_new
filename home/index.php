<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="index.css">
    <link rel="icon" href="asserts/icons/icon.png">
    <title></title>
  </head>
  <body>
    <section class='nav'>
      <nav style="width: 100%;height: 100%">
        <img src="asserts/icons/icon.png" alt="Logo" style="width:auto;height: 100%; margin-left: 2vw;">
        <form class="search" action="" method="post" style="width: 30%;height: 50%;display:flex;" >
          <input type="text" name="search-input" class="search-input" value="" placeholder="Search in tasks....">
          <input type="button" name=""  id="search"value="" style="border:0; width: 10%;height: 108%; margin:0">
        </form>
        <?php
        $link=mysqli_connect("localhost", "adil", "221634adil", "test");
        if (isset($_COOKIE['id']) and isset($_COOKIE['hash']))
        {
            $query = mysqli_query($link, "SELECT * FROM user WHERE user_id = '".intval($_COOKIE['id'])."' LIMIT 1");
            $userdata = mysqli_fetch_assoc($query);
            echo $userdata['user_login'];
        }
         ?>
        <a href="" class="profile"  style="height: 100%;width: 5%;margin-right: 2vw;"></a>
      </nav>
    </section>
    <section class="content" >
        <section class="tabs">
          <div class="tabs-box" style="width:100%;height:70%;margin:3vw 0 auto auto;display:flex;flex-direction:column;">
            <button type="button" class="active" name="button" style="background-image: url('asserts/icons/0.png');" onclick="setActive(0)">Important</button>
            <button type="button" name="button" style="background-image: url('asserts/icons/1.png');" onclick="setActive(1)">Today tasks</button>
            <button type="button" name="button" style="background-image: url('asserts/icons/2.png');" onclick="setActive(2)">Planned tasks</button>



          </div>
        </section>
        <section class="main-content">
          <div id="important" class="index showing" >
            <div class="info">
              <div class="">
                <h2>Important</h2>
                <!-- <?php
                $servername = "localhost";
                $username = "adil";
                $database = "test";
                $password = "221634adil";

                //  Create a new connection to the MySQL database using PDO
                $conn = new mysqli($servername, $username, $password);

                // Check connection
                if ($conn->connect_error) {
                  die("Connection failed: " . $conn->connect_error);
                }
                echo "Connected successfully";
                $sql = "INSERT INTO test.Users (Username, Password, Email) VALUES ('Test', '123', 'thom.v@some.com')";
                if (mysqli_query($conn, $sql)) {
                      echo "New record created successfully";
                } else {
                      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }
                mysqli_close($conn);
                 ?> -->
              </div>
            </div>
            <div class="tasks">
              <div class="task">
                <form id="forma">
                  <input type="text" class="addTask" name="" value="">
                </form>
                <script>

                document.getElementById("forma").addEventListener("submit", function(event){
                  event.preventDefault()
                  alert('i tracked it')
                });

                </script>
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
          <div id="today" class="index">
            <div class="info">
              <div class="">
                <h2>Today tasks</h2>
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
            <button type="button" name="button" onclick="resize()" >open</button>
          </div>
          <div id="planned" class="index">
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
        </section>
        <div class="edit">

        </div>

    </section>
    <script type="text/javascript" src='index.js'>

    </script>
  </body>
</html>
