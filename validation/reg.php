<?php
    $login_user = filter_var(trim($_POST['log']), FILTER_SANITIZE_STRING);
    $name_user = filter_var(trim($_POST['name']), FILTER_SANITIZE_STRING);
    $pass_user = filter_var(trim($_POST['pass']), FILTER_SANITIZE_STRING);

    if(mb_strlen($login_user) < 4 || mb_strlen($login_user) > 90) {
        echo "Недопустимая длина логина (от 4 до 90)";
        exit;
    } else if(mb_strlen($login_user) < 3 || mb_strlen($login_user) > 50) {
        echo "Недопустимая длина имени (от 3 до 50)";
        exit;
    } else if(mb_strlen($login_user) < 2 || mb_strlen($login_user) > 12) {
        echo "Недопустимая длина пароля (от 2 до 12 символов)";
        exit;
    }

    include '../config/salt.php';
    $pass_user = md5($pass_user.$salt); 

    include '../config/users_db_info.php';
    $mysql = new mysqli($host, $log, $pass, $db_name);

    $mysql->query("INSERT INTO `users` (`login`, `pass`, `name`) VALUES('$login_user', '$pass_user', '$name_user')");

    $result = $mysql->query("SELECT * FROM `users` WHERE `login` = '$login_user' AND `pass` = '$pass_user'");
    
    $user = $result->fetch_assoc();

    session_start();
    $_SESSION["user"] = 'true';
    $_SESSION["user_id"] = $user['id'];

    $mysql->close();

    header('Location: /');
?>