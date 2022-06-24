<head>
    <link rel="stylesheet" href="css/header.css">
</head>
<header class="p-3 bg-dark text-white">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <a href="/">
            <div>
            <img height="60" src="../img/logo.png" alt="логотип" title="Вернуться на главную страницу.">
            </div>
        </a>

        <form  class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0" action="index.php" method="POST">
            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                <li><button type="submit" class="me-2 btn-outline-light btn btn-dark" 
                title="Актуальные новости в сфере науки." 
                name="science">Наука</button></li>
                <li><button type="submit" class="me-2 btn-outline-light btn btn-dark" 
                title="Актуальные новости в сфере медицины." 
                name="health">Медицина</button></li>
                <li><button type="submit" class="me-2 btn-outline-light btn btn-dark" 
                title="Актуальные новости в сфере бизнеса." 
                name="business">Бизнес</button></li>
            </ul>
        </form>

        <form action="../search/word_search.php" method="POST">
            <div class="text-end">
                <button type="submit" name="word_search" class="btn btn-outline-light me-2">Поиск</button>
            </div>
        </form>
        
        <?php session_start(); ?>
        <form action="../validation/user_log_form.php" method="POST">
        <div class="text-end">
            <?php if($_SESSION["user"] == 'true'): ?>
                <button type="submit" name="acc" class="btn btn-warning">Кабинет пользователя</button>
            <?php else: ?>
                <button type="submit" name="auth" class="btn btn-outline-light me-2">Войти</button>
                <button type="submit" name="reg" class="btn btn-warning">Регистрация</button>
            <?php endif; ?>
        </div>
        </form>
      </div>
    </div>
  </header>