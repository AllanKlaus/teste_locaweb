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
            $caminho = $_SERVER['DOCUMENT_ROOT']."/teste_locaweb/trunk/"; // Pegando o caminho da pasta do projeto
            require_once $caminho."Tweet.php"; // Criada para guardar os dados de cada tweet
            require_once $caminho."ResultadoTweet.php"; // Criada para guardar os dados que deverão integrar resultado final

            $listaTweet = unserialize($_SESSION['tweets']);// Pegando a lista de tweets guardada na session
            $listagemTweets = array();
            
            // Ordenando os tweets de acordo com a avaliação feita anteriormente
            usort(
                $listaTweet,
                function($a,$b) {
                    if($a->getAvaliacao() == $b->getAvaliacao()) return 0;
                    return (($a->getAvaliacao() > $b->getAvaliacao()) ? -1 : 1 );
                }
            );
            
            // Inserindo os dados necessários para geração do JSON e impressão na tela
            for ($i=0; $i<(count($listaTweet)); $i=$i+1){
                $resultado = new ResultadoTweet();
                
                $resultado->setCreated_at($listaTweet[$i]->getCreatAt()); // Data/Hora do tweet
                $resultado->setFavourites_count($listaTweet[$i]->getFavoritesCount()); // Número de likes
                $resultado->setFollowers_count($listaTweet[$i]->getFollowersCount()); // Número de seguidores
                $resultado->setRetweet_count($listaTweet[$i]->getRetweetCount()); // Número de Retweet
                $resultado->setScreen_name($listaTweet[$i]->getScreenName()); // Screen name
                $resultado->setText($listaTweet[$i]->getText()); // Texto do tweet
                $resultado->setLink_perfil('http://www.twitter.com/'.$listaTweet[$i]->getScreenName()); // Link para perfil do usuário
                $resultado->setLink_tweet('http://www.twitter.com/'.$listaTweet[$i]->getScreenName().'/status/'.$listaTweet[$i]->getId_str_tweet()); // Link para o tweet                
                
                array_push($listagemTweets, $resultado);
            }
            // "Transformando" o vetor de tweets relevantes para um JSON
            $json = json_encode($listagemTweets);
            //Salvando este arquivo JSON
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
                // Listando os tweets mais relevantes de acordo com a avaliação feita
            echo '<div class="container">';
                echo '<div class="row">';
                    foreach ($listagemTweets as $lt){
                        $i = $i+1;
                        echo '
                            <div class="col-md-4">
                            <h2><a href="'.$lt->getLink_perfil().'" target="_blank">@'.$lt->getScreen_name().'</a></h2>
                            <h5><a href="'.$lt->getLink_tweet().'" target="_blank">'.$lt->getCreated_at().'</a></h5>
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
