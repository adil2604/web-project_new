<?php
if (isset($_GET['logout'])){
    setcookie('id','',time()-3600*24*24*60,"/");
    setcookie('hash','',time()-3600*24*24*60,"/");
    header("Location: ../home/index.php");

}
?>


<a href="?logout=1">Log Out</a>


