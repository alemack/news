<?php
    require_once '../vendor/autoload.php';
    use jcobhams\NewsApi\NewsApi;
    include '../config/api_key.php';
    $newsapi = new NewsApi($api_key);
   // session_start();
    $userId = $_SESSION["user_id"];
?>

<?php if($_SESSION["user"] == ''): ?>
        <h1>Авторизуйтесь, пожалуйста.</h1>
<?php else: ?>
<?php   
        if (isset($_POST['id_favorites_regular'])):
            $i = $_POST['id_favorites_regular'];
            $param = "ru";
            $articles = $newsapi->getEverything($param);
        elseif (isset($_POST['id_favorites_headline'])):
            $i = $_POST['id_favorites_headline'];
            $param = $_POST['category'];
            $articles = $newsapi->getTopHeadlines($param);
        endif;
            $articles = $articles->articles;

            $title = $articles[$i]->title;
            $author = $articles[$i]->author;
            $description = $articles[$i]->description;
            $url = $articles[$i]->url;
            $urlToImage = $articles[$i]->urlToImage;
            $publishedAt = $articles[$i]->publishedAt;
            $publishedAt = date('d.m.Y', (strtotime(substr($publishedAt, 0, 10))));
            $content = $articles[$i]->content;

            include '../config/regular_db_info.php';
            $mysql = new mysqli($host, $log, $pass, $db_name);

            if(!($mysql->connect_error)) {      
                $mysql->query("SET NAMES 'utf8'");

                $result=$mysql->query("SELECT * FROM `regular` WHERE `url` = '$url'");
                $row = $result->fetch_assoc();

                $url_tab = $row['url'];
                $user_id = $row['users_id'];
                // если в таблице уже есть такая запись
                if($url_tab == $url) { 
                    // если эта запись принадлежит текущему пользователю
                    if($user_id == $userId):
                        echo 'Вы уже добавили эту новость в избранное.';
                    elseif($user_id != $userId):
                        // добавляем запись для текущего пользователя
                        $mysql->query("INSERT INTO `regular` (`users_id`, `title`, `author`, `description`, `url`, `url_to_image`, `published_at`, `content`) VALUES('$userId', '$title', '$author', '$description', '$url', '$urlToImage', '$publishedAt', '$content')");
                        echo 'Новость успешно добавлена в избранное.';
                    endif;
                } else {
                    // добавляем абсолютно новую запись в таблице
                    $mysql->query("INSERT INTO `regular` (`users_id`, `title`, `author`, `description`, `url`, `url_to_image`, `published_at`, `content`) VALUES('$userId', '$title', '$author', '$description', '$url', '$urlToImage', '$publishedAt', '$content')");
                    echo 'Новость успешно добавлена в избранное.';
                }

            } else {
                echo 'Error Number: '.$mysql->connect_errno.'<br/>';
                echo 'Error '.$mysql->connect_error;
            }
            $mysql->close();
?> 
<br><br>
<a href="/"><button>Назад</button></a>
<?php endif; ?>