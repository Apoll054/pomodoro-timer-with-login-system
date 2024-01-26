<?php

$is_invalid = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $mysqli = require __DIR__ . "/database.php";
    
    $sql = sprintf("SELECT * FROM user
                    WHERE email = '%s'",
                   $mysqli->real_escape_string($_POST["email"]));
    
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();
    
    if ($user) {
        
        if (password_verify($_POST["password"], $user["password_hash"])) {
            
            session_start();
            
            session_regenerate_id();
            
            $_SESSION["user_id"] = $user["id"];
            
            header("Location: index.php");
            exit;
        }
    }
    
    $is_invalid = true;
}

?>
<!DOCTYPE html>
<html>
<head>
        <meta charset="UTF-8">
        <meta name="vieport" content="width=device-width", initial-scale="1.0">
        <title>Productivity Center Signup</title>
        <!---------------------fonts----------------------->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600&display=swap" rel="stylesheet">
        <!---------------------Stylesheet----------------------->
        <link rel="stylesheet" href="./signupstyle.css">
    </head>
<body>
<section>
         <div class="container">
         <h1><?php if ($is_invalid): ?>Invalid login<?php else: ?>Login<?php endif; ?></h1>
            <div class="panel">
            <form class="login-form" method="post">
                    <div class="label-container">
                    <label for="email">Email:</label>
                    </div>
                    <div>
                    <input type="email" name="email" id="email"
               value="<?= htmlspecialchars($_POST["email"] ?? "") ?>">
                    </div>
                    <div class="label-container">
                    <label for="password">Password:</label>
                    </div>
                    <div><input type="password" name="password" id="password">
                    </div>
                    <button>Log in</button>
                </form>
            </div>
         </div>
        </section>
</body>
</html>