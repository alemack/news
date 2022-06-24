<!DOCTYPE html>
<html lang="ru">
<head>
    <link rel="stylesheet" href="css/canvas.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
</head>

<?php
    use jcobhams\NewsApi\NewsApi;
    include './config/api_key.php';
    $newsapi = new NewsApi($api_key);

    # $q = "";
    # $sources = "";
    # $domains = "";
    # $exclude_domains = "";
    # $from = "";
    # $to = "";
    $language = "ru";
    # $sort_by = "";
    # $page_size = "";  
    # $page = "";

    $articles = $newsapi->getEverything($language);
    $articles = $articles->articles; 
    $count = count($articles);
?>

<form action="blocks/advanced_features.php" method="POST">
    <div class="container mt-5">
        <h3 align="center">Новости-><?php echo $count ?> </h3>
        <div class="d-flex flex-wrap">
            <?php
                for($i = 0; $i < $count; $i++):
            ?>
            <?php
                    $title = $articles[$i]->title;
                    $author = $articles[$i]->author;
                    $description = $articles[$i]->description;
                    $url = $articles[$i]->url;  
                    $urlToImage = $articles[$i]->urlToImage;
                    $publishedAt = $articles[$i]->publishedAt;
                    $date = date('d.m.Y', (strtotime(substr($publishedAt, 0, 10))));
                    $content = $articles[$i]->content;
            ?>
                    <div class="card mb-4 rounded-3 shadow-sm">
                        <div align="center" class="card-header py-3">
                            <h5 class="my-0 fw-normal"><a href=<?=$url?>> <?php echo $title; ?> </a></h5>
                        </div>
                        <div class="card-body">
                            <div class="pict">
                                <img height="100"  alt ="Картинка новости." src= <?php echo $urlToImage; ?> class="img-thumbnail">
                            </div>
                            <div align="justify">
                                <ul class="list-unstyled mt-3 mb-4">
                                    <?php if($description): ?>
                                        <li><a><strong>Описание:</strong> <?php echo $description ?></a></li> <hr/>
                                    <?php endif; ?>
                                    <?php if($author): ?>
                                        <li><a><strong>Автор:</strong> <?php echo $author ?></a></li> <hr/>
                                    <?php elseif(!$author): ?>
                                        <li><a><strong>Автор:</strong> Отсутствует</a></li> <hr/>
                                    <?php endif; ?>
                                    <?php if($date): ?>
                                        <li><a><strong>Дата публикации:</strong> <?php echo $date ?></a></li> <hr/>
                                    <?php endif; ?>
                                </ul>
                            </div>
                            <div class="d-flex justify-content-center py-3">
                                <ul class="nav nav-pills">
                                    <li class="nav-item">
                                        <button class="add_favorites" style="border:0; background: rgb(234, 236, 239);" 
                                            type="submit" name="id_favorites_regular" value=<?=$i?>>
                                        <a href="#" class="nav-link" aria-current="page">
                                            <svg xmlns="../img/star.svg" width="30" height="30" fill="currentColor" class="be be-star" viewBox="0 0 16 16">
                                                <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"/>
                                            </svg>
                                        </a>
                                        </button>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <svg xmlns="../img/chat-dots.svg" width="30" height="30" fill="currentColor" class="bi bi-chat-dots" viewBox="0 0 16 16">
                                                <path d="M5 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
                                                <path d="m2.165 15.803.02-.004c1.83-.363 2.948-.842 3.468-1.105A9.06 9.06 0 0 0 8 15c4.418 0 8-3.134 8-7s-3.582-7-8-7-8 3.134-8 7c0 1.76.743 3.37 1.97 4.6a10.437 10.437 0 0 1-.524 2.318l-.003.011a10.722 10.722 0 0 1-.244.637c-.079.186.074.394.273.362a21.673 21.673 0 0 0 .693-.125zm.8-3.108a1 1 0 0 0-.287-.801C1.618 10.83 1 9.468 1 8c0-3.192 3.004-6 7-6s7 2.808 7 6c0 3.193-3.004 6-7 6a8.06 8.06 0 0 1-2.088-.272 1 1 0 0 0-.711.074c-.387.196-1.24.57-2.634.893a10.97 10.97 0 0 0 .398-2z"/>
                                            </svg>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <svg xmlns="..img/share.svg" width="27" height="27" fill="currentColor" class="bi bi-share" viewBox="0 0 16 16">
                                                <path d="M13.5 1a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zM11 2.5a2.5 2.5 0 1 1 .603 1.628l-6.718 3.12a2.499 2.499 0 0 1 0 1.504l6.718 3.12a2.5 2.5 0 1 1-.488.876l-6.718-3.12a2.5 2.5 0 1 1 0-3.256l6.718-3.12A2.5 2.5 0 0 1 11 2.5zm-8.5 4a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zm11 5.5a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3z"/>
                                            </svg>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
            <?php
                endfor; 
            ?>
        </div>   
    </div>
</form>