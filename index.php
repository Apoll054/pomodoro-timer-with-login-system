<?php

session_start();

if (isset($_SESSION["user_id"])) {
    
    $mysqli = require __DIR__ . "/database.php";
    
    $sql = "SELECT * FROM user
            WHERE id = {$_SESSION["user_id"]}";
            
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();
}

?>
<!DOCTYPE html>
<html>
<head>
        <meta charset="UTF-8">
        <meta name="vieport" content="width=device-width", initial-scale="1.0">
        <title>Productivity Center</title>
        <!---------------------fonts----------------------->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600&display=swap" rel="stylesheet">

        <!---------------------icons----------------------->
        <script src="https://kit.fontawesome.com/b40c34b053.js" crossorigin="anonymous"></script>
        <!---------------------Stylesheet----------------------->
        <link rel="stylesheet" href="./style.css">
<body>
<section>
         <div class="container">
        
            <h1> <?php if (isset($user)): ?>
        
        <p>Hello, <span><?= htmlspecialchars($user["name"])?></span></p></h1>
        
        <p><a href="logout.php">Log out</a></p>
        
    <?php else: ?>
        <h1> 
        
        <p>You are <span> Logged out</span></p></h1>
       <p><a href="login.php">Log in</a> or <a href="signup.html">sign up</a></p>
        
    <?php endif; ?>
            
            <div class="panel">
                <button id="focus" class="btn btn-timer btn-focus">Pomodoro</button>
                <button id="shortbreak" class="btn btn-shortbreak">Short Break</button>
                <button id="longbreak" class="btn btn-longbreak">Long Break</button>
            </div>
            <div class="timer">
                <div class="circle">
                <div class="time-btn-container">
                    <span id="time"></span>
                </div>
                </div>
            </div>
           <div class="btn-container">
            <button id="btn-start" class="show">Start</button>
            <button id="btn-pause" class="hide">Pause</button>
            <button id="btn-reset" class="hide"><i class="fa-solid fa-rotate-right"></i></button>

           </div>
         </div>
        </section>
        <script src="script.js"></script>
   
    
</body>
</html>
    
    
    
    
    
    
    
    
    
    
    