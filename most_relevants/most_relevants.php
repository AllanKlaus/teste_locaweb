<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <?php
            session_start();
            $caminho = $_SERVER['DOCUMENT_ROOT']."/locaweb/trunk/";
            require_once $caminho."Tweet.php";

            $listaTweet = unserialize($_SESSION['tweets']);
            
            echo '<ul>';
            $i = count($listaTweet);
            for ($y=0; $y<$i; $y = $y+1){
                echo '<li>';
                echo 'Screen Name: <a href=\'http://www.twitter.com/'.$listaTweet[$y]->getScreenName().'\'>'.$listaTweet[$y]->getScreenName().'<a/>'; 
                echo '</li>';
                
                echo '<li>';
                echo 'Número de seguidores: '; echo $listaTweet[$y]->getFollowersCount();
                echo '</li>';
                
                echo '<li>';
                echo 'Número de retweets: '; echo $listaTweet[$y]->getRetweetCount();
                echo '</li>';
                
                echo '<li>';
                echo 'Número de likes do tweet: '; echo $listaTweet[$y]->getFavoritesCount();
                echo '</li>';
                
                echo '<li>';
                echo 'Conteúdo do tweet: '; echo $listaTweet[$y]->getText();
                echo '</li>';
                
                echo '<li>';
                echo 'Data e hora do tweet: <a href=\'http://www.twitter.com/'.$listaTweet[$y]->getScreenName().'/status/'.$listaTweet[$y]->getId_str_tweet().'\'>'.$listaTweet[$y]->getCreatAt().'<a/>'; 
                echo '</li>';
            }
            echo '</ul>';
        ?>
    </body>
</html>
