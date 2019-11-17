<style>

    .nav{
        width: 100%;
        height:4vw;
        background-color: #0078D7;
    }
    nav{
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        flex-wrap: nowrap;
        align-items: center;
    }

    .search-input{
        border: 0;
        border-top-left-radius: 2px;
        border-bottom-left-radius: 2px;
        padding-left: 2vw;
        width: 70%;
        height: 100%;
        font-family: 'Josefin Sans', sans-serif;
        font-size: 1vw;


    }
    #search{
        background-image: url("../asserts/icons/icon_search.png");
        border-top-right-radius: 2px;
        border-bottom-right-radius: 2px;
        background-position: center;
        background-repeat: no-repeat;
        background-size: 2vw;
        transition: 0.6s;
    }
    #search:hover{
        background-color: black;
        background-size: 2.4vw;
    }


    .profile{
        background-image: url('../asserts/icons/profile.png');
        background-position: center;
        background-repeat: no-repeat;
        background-size: 2.7vw;
        border-left: 1px solid rgba(0, 0, 0, 0.2);
        border-right: 1px solid rgba(0, 0, 0, 0.2);
        transition: 0.6s;

    }
    .profile:hover{
        background-color: rgba(0, 0, 0, 0.1);
    }
</style>

<section class='nav'>
    <nav style="width: 100%;height: 100%">
        <img src="../asserts/icons/icon.png" alt="Logo" style="width:auto;height: 100%; margin-left: 2vw;">
        <form class="search" action="" method="post" style="width: 30%;height: 50%;display:flex;margin-block-end: 0" >
            <input type="text" name="search-input" class="search-input" value="" placeholder="Search in tasks....">
            <input type="button" name=""  id="search"value="" style="border:0; width: 10%;height: 100%; margin:0">
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
        <a href="<?php if (isset($_COOKIE['id'])){echo "../login/profile.php";}else {echo "../login/login.php";}  ?>" class="profile"  style="height: 100%;width: 5%;margin-right: 2vw;"></a>
    </nav>
</section>