<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/auth.css">
    <title>OpenNews</title>
</head>
<body>
    <?php session_start(); ?>
    
    <?php if(isset($_POST['auth'])): ?>
        <form action="auth.php" method="POST">
            <div class="form">
                <h1>Вход</h1>
                <div class="input-form">
                    <input type="text" name="log" id="log" placeholder="Логин">
                </div>
                <div class="input-form">
                    <input type="password" name="pass" id="pass" placeholder="Пароль">
                </div>
                <div class="input-form">
                    <input type="submit" value="Войти">
                </div>
                <a href="#" class="forget">Забыли пароль?</a>
            </div>
        </form>
    <?php elseif(isset($_POST['reg'])): ?>
        <form action="reg.php" method="POST">
            <div class="form">
                <h1>Регистрация</h1>
                <div class="input-form">
                    <input type="text" name="log" id="log" placeholder="Логин">
                </div>
                <div class="input-form">
                    <input type="text" name="name" id="name" placeholder="Имя">
                </div>
                <div class="input-form">
                    <input type="password" name="pass" id="pass" placeholder="Пароль">
                </div>
                <div class="input-form">
                    <input type="submit" value="Зарегистрироваться">
                </div>
                <a href="#" class="forget">Забыли пароль?</a>
            </div>
        </form>
    <?php elseif(isset($_POST['acc'])): ?>
        <?php header('Location: http://news/account/user_account.php') ?>
    <?php endif; ?>
</body>
</html>