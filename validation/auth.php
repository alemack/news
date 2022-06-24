<?php
    $login_user = filter_var(trim($_POST['log']), FILTER_SANITIZE_STRING);
    $pass_user = filter_var(trim($_POST['pass']), FILTER_SANITIZE_STRING);

    include '../config/salt.php';
    $pass_user = md5($pass_user.$salt); 

    include '../config/users_db_info.php';
    $mysql = new mysqli($host, $log, $pass, $db_name);

    $result = $mysql->query("SELECT * FROM `users` WHERE `login` = '$login_user' AND `pass` = '$pass_user'");
    
    $user = $result->fetch_assoc();

    if(count($user) == 0) {
        // поставить оповещение js
        echo "Такой пользователь не найден";
        exit();
    }

    session_start();
    $_SESSION["user"] = 'true';
    $_SESSION["user_id"] = $user['id'];

    $mysql->close();

    header('Location: /');
?>