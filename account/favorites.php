<?php
    session_start();
    $userId = $_SESSION["user_id"];
?>

<?php
    include '../config/regular_db_info.php';
    $mysql = new mysqli($host, $log, $pass, $db_name);
    
    if(!($mysql->connect_error)) {      
        $mysql->query("SET NAMES 'utf8'");

        $result=$mysql->query("SELECT * FROM `regular` WHERE `users_id` = '$userId'"); 
        $num_rows = $result->num_rows;
        $sub = $num_rows;
        ?> 
        <table>
        <?php
        while ($row = $result->fetch_assoc()) { 
            $sub = $sub -1;
            $id = $num_rows - $sub;
            $id_news_tab = $row['id'];
            $title = $row['title']; 
            $author = $row['author'];
            $published_at = $row['published_at'];
            $url = $row['url'];
            // print_r($result->field_count); // количество столбцов в таблице
            // print_r($result->num_rows); // количество новостей 
            ?>
            <form action="../account/delete.php" method="POST">
            <tr>
                <td><?php echo $id ?></td>
                <td><a href=<?=$url?>> <?php echo $title; ?> </a></td>
                <td><?php if($author):echo $author;
                          else: echo 'Отсуствует'; 
                        endif;      ?></td>
                <td><?php echo $published_at ?></td>
                <td><input type="hidden" name="$id_news_tab" value=<?=$id_news_tab?>>
                    <button type="submit" name="delete">Удалить</button></td>
            </tr>
            </form>
            <?php
        }
        ?>
        </table> 
        <?php

        $url_tab = $row['url'];
        $user_id = $row['users_id'];
        $news_id = $row['id'];

    } else {
        echo 'Error Number: '.$mysql->connect_errno.'<br/>';
        echo 'Error '.$mysql->connect_error;
    }
    $mysql->close();
?>
<br><br>
<a href="http://news/account/user_account.php"><button>Назад</button></a>

