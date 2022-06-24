<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/canvas.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <title>OpenNews</title>
</head>
<body>
    <?php require_once '../news/vendor/autoload.php'; ?>
    <?php require "blocks/header.php"; ?>
    
    <?php
        if(isset($_POST['science']) || isset($_POST['health']) || isset($_POST['business'])):
            require "blocks/headline_news.php";
        else:
            require "blocks/regular_news.php";  
        endif;
    ?>

    <?php require "blocks/footer.php"; ?>
</body>
</html>