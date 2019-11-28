<style>

    .nav {
        width: 100%;
        height: 4vw;
        background-color: #0078D7;
    }

    nav {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        flex-wrap: nowrap;
        align-items: center;
    }

    .search-input {
        border: 0;
        border-top-left-radius: 2px;
        border-bottom-left-radius: 2px;
        padding-left: 2vw;
        width: 70%;
        height: 100%;
        font-family: 'Josefin Sans', sans-serif;
        font-size: 1vw;


    }

    #search {
        background-image: url("../asserts/icons/icon_search.png");
        border-top-right-radius: 2px;
        border-bottom-right-radius: 2px;
        background-position: center;
        background-repeat: no-repeat;
        background-size: 2vw;
        transition: 0.6s;
    }

    #search:hover {
        background-color: black;
        background-size: 2.4vw;
    }


    .profile {
        background-position: center;
        border-radius: 50%;
        background-repeat: no-repeat;
        background-size: 3vw;
        border-left: 1px solid rgba(0, 0, 0, 0.2);
        border-right: 1px solid rgba(0, 0, 0, 0.2);
        transition: 0.6s;

    }

    .profile:hover {
        background-color: rgba(0, 0, 0, 0.1);
    }
</style>

<section class='nav'>
    <nav style="width: 100%;height: 100%">
        <img src="../asserts/icons/icon.png" alt="Logo" onclick="window.location='/home/index.php'" style=" width:auto;height: 100%;cursor:pointer; margin-left: 2vw;">
        <form class="search" action="" method="post" style="width: 30%;height: 50%;display:flex;margin-block-end: 0">
            <input type="text" name="search-input" class="search-input" value="" placeholder="Search in tasks....">
            <input type="button" name="" id="search" value="" style="border:0; width: 10%;height: 100%; margin:0">
        </form>
        <?php
        $link = mysqli_connect("localhost", "adil", "221634adil", "test");
        $user = mysqli_query($link, "SELECT * FROM user WHERE user_id='" . $_COOKIE['id'] . "' LIMIT 1");
        $user = mysqli_fetch_assoc($user);
        $image_path = $user['image_path'];
        if($image_path==''){
            $image_path="../asserts/images/proflie.png";
        }
        ?>
        <a href="../login/profile.php" class="profile"
           style="background-image: url(<?php echo $image_path; ?>); height: 70%;width: 3%;margin-right: 2vw;"></a>
    </nav>
</section>