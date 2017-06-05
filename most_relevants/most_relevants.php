<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="../css/jumbotron.css" rel="stylesheet" type="text/css">
        <link href="../css/bootstrap.css" rel="stylesheet" type="text/css">
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
            
            $json = json_encode($listagemTweets);
            
            $fp = fopen('arquivo.json', 'w');
            fwrite($fp, $json);
            fclose($fp);
        ?>
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">
              <div class="navbar-header">
                <a class="navbar-brand" href="javascript:window.history.go(-1)">Página Inicial</a>
              </div>
            </div>
        </nav>
        <div class="jumbotron">
            <div class="container">
              <p>Aqui estão listados os tweets classificados como mais relevantes para a Locaweb. Um arquivo JSON foi gerado no diretório com todos os dados apresentados abaixo.</p>
              <p><a class="btn btn-primary btn-lg" href="arquivo.json" target="_blank" role="button">Visualizar JSON &raquo;</a></p>
            </div>
          </div>
          <?php
                $i = 0;                
                echo '<div class="container">';
                echo '<div class="row">';
                foreach ($listagemTweets as $lt){
                    $i = $i+1;
                    echo '
                        <div class="col-md-4">
                        <h2><a href="'.$lt->getLink_perfil().'" target="_blank">@'.$lt->getScreen_name().'</a></h2>
                        <h5><a href="'.$lt->getLink_tweet().'" target="_blank">@'.$lt->getCreated_at().'</a></h5>
                        <p><b>'.$lt->getText().'</b></p>
                        <p>'.$lt->getFollowers_count().' seguidores </p>
                        <p>'.$lt->getRetweet_count().' retweets</p>
                        <p>'.$lt->getFavourites_count().' likes</p>
                        
                        </div>';
                    if ($i == 3){
                        $i = 0;
                        echo '</div>';
                        echo '<div class="row">';
                    }
                }
                echo '</div>';
            echo '</div>';
          ?>
          <hr>
        </div>
    </body>
</html>
