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
            /*function idUser($lista, $id) {
                return ($lista->getId_str_user() == $id);
            }*/
        
            session_start();
            $caminho = $_SERVER['DOCUMENT_ROOT']."/teste_locaweb/trunk/";
            require_once $caminho."Tweet.php";

            $listaTweet = unserialize($_SESSION['tweets']);
            $idUsers = unserialize($_SESSION['idUsers']);
            
            $mostMentionsLocaweb = array();
            
            for ($i=0; $i<count($idUsers);$i=$i+1){
                $id = $idUsers[$i];
                $ret = array_filter($listaTweet, function ($lista) use ($id){
                                                    return $lista->getId_str_user() == $id;
                                                 }
                        );
                array_push($mostMentionsLocaweb, $ret);
            }
            
            var_dump($mostMentionsLocaweb);
            
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
            echo '</ul>';*/
        ?>
    </body>
</html>
