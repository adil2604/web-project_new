<?php
if (isset($_COOKIE['hash'])){
    header("Location: /home");
}

?>



<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="asserts/icons/icon.png">
    <title>Get started with Do It Now!</title>
  </head>
  <body>
<!--  HEADER AREA--------------------->
   <div class="header">
       <nav>
           <div class="navbar">
               <img src="asserts/icons/icon.png" style="margin-left:2vw;:max-width: 1%;max-height: 80%">
               <p >Do It Now!</p>
               <div class="links">
                   <a href="#">Home</a>
                   <a href="#about">About</a>
                   <a href="#contacts">Contacts</a>
               </div>
               <button id="start" class="start">Get Started!</button>
           </div>
       </nav>

       <div class="preview">
           Get started with the powerful task-management tool <br>
           <button id="start" class="start">Start!</button>
       </div>
   </div>
<!--  MAIN AREA ---------------------->
   <main id="about">
    <div class="content" >
        <div class="preview-box">
            <div class="preview">
                Relieve your mind
            </div>
            <div class="preview min">Get clarity and calm - move your tasks from your head to your to-do list (no matter where you are or what device you use).</div>

        </div>
        <div class="content-box">
            <div class="reviews">
                <div class="review">
                    <p>The Verge</p>
                    <div>
                        <b>9/10</b><br>
                        “The best to-do list today
                        in the application"
                    </div>

                </div>
                <div class="review star">
                    <p>Google Play</p>
                    Editor's Choice
                    rating 4.5, 177+ thousand reviews
                </div>
                <div class="review star">
                    <p>App Store</p>
                    Application of the day
                    rating 4.8, 30+ thousand reviews
                </div>

            </div>

        </div>

        <div class="main">
            <div class="preview x">Do It Now! helped million of people to do their tasks</div>
            <div class="main-box">
                <div class="preview min">using Do It Now! will lead you to unprecedented success. Since now you do not have to memorize unnecessary information, it is quite simple to write in Do It Now! and we ourselves will say about it!</div>
            </div>
<!--            <img src="asserts/images/peace.png">-->
            <div class="main-box">
                <div class="preview min">using Do It Now! will lead you to unprecedented success. Since now you do not have to memorize unnecessary information, it is quite simple to write in Do It Now! and we ourselves will say about it!</div>
            </div>
        </div>
    </div>
   </main>

<!--   FOOTER AREA-------------------->
   <footer>
        <div class="footer begin">
            <div class="preview min marginz">So, get started with Do it Now!</div>
            <button id='start' class="start big">To Do tasks!</button>
        </div>
       <div class="footer email">
           <div class="preview min marginz">Subscribe to our news!</div>

           <form class="" action="" method="post">
               <input class="big input" type="email" placeholder="Email">
           </form>
       </div>
        <div id="contacts" class="footer contact">

            <div class="preview min marginz">Our contacts :</div>
            <ul>
                <li>adil@doitnow.com</li>
                <li>+7751840677</li>
                <li>Kaskelen, Abylaikhan Street 1/1</li>
            </ul>
        </div>
   </footer>
    <script type="text/javascript" src='script.js'>

    </script>
  </body>
</html>
