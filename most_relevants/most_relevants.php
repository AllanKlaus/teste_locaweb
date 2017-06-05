<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="css/carousel.css" rel="stylesheet" type="text/css" media="screen">
        <title>Tweets</title>
    </head>
    <body>
        <?php
            session_start();
            $caminho = $_SERVER['DOCUMENT_ROOT']."/teste_locaweb/trunk/";
            require_once $caminho."Tweet.php";
            require_once $caminho."ResultadoTweet.php";

            $listaTweet = unserialize($_SESSION['tweets']);
            $listagemTweets = array();
            
            usort(
                $listaTweet,
                function($a,$b) {
                    if($a->getAvaliacao() == $b->getAvaliacao()) return 0;
                    return (($a->getAvaliacao() > $b->getAvaliacao()) ? -1 : 1 );
                }
            );
            
            //var_dump($listaTweet);
            for ($i=0; $i<(count($listaTweet)); $i=$i+1){
                $resultado = new ResultadoTweet();
                
                $resultado->setCreated_at($listaTweet[$i]->getCreatAt());
                $resultado->setFavourites_count($listaTweet[$i]->getFavoritesCount());
                $resultado->setFollowers_count($listaTweet[$i]->getFollowersCount());
                $resultado->setRetweet_count($listaTweet[$i]->getRetweetCount());
                $resultado->setScreen_name($listaTweet[$i]->getScreenName());
                $resultado->setText($listaTweet[$i]->getText());
                $resultado->setLink_perfil('http://www.twitter.com/'.$listaTweet[$i]->getScreenName());
                $resultado->setLink_tweet('http://www.twitter.com/'.$listaTweet[$i]->getScreenName().'/status/'.$listaTweet[$i]->getId_str_tweet());
                
                
                array_push($listagemTweets, $resultado);
            }
            
            echo $json = json_encode($listagemTweets);
            /*echo '<ul>';
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
            echo '</ul>';    */
        ?>
    </body>
</html>
