<?php
    if(isset($_POST['delete'])):
        session_start();
        $userId = $_SESSION["user_id"];    
        $id_news_tab = $_POST['$id_news_tab'];

        include '../config/regular_db_info.php';
        $mysql = new mysqli($host, $log, $pass, $db_name); 

        if(!($mysql->connect_error)) {      
            $mysql->query("SET NAMES 'utf8'");
    
            $result=$mysql->query("DELETE FROM `regular` WHERE `id` = '$id_news_tab'"); 
         //   $row = $result->fetch_assoc();
          //  $id = $row['id'];
           // $url = $row['url'];
           //echo $id;   
          //  echo $url;
            // echo $id_news_tab;
           
        echo 'Запись была удалена';

    
        } else {
            echo 'Error Number: '.$mysql->connect_errno.'<br/>';
            echo 'Error '.$mysql->connect_error;
        }
        $mysql->close();
    endif;
?>
<br><br>
<a href="http://news/account/favorites.php"><button>Назад</button></a> <br><br>