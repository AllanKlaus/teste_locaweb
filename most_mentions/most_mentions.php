<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="../css/bootstrap.css" rel="stylesheet" type="text/css">
        <link href="../css/jumbotron.css" rel="stylesheet" type="text/css">
        <title>Usuários</title>


    
    </head>
    
    <body>
        <?php
            /*function idUser($lista, $id) {
                return ($lista->getId_str_user() == $id);
            }*/
        
            session_start();
            $caminho = $_SERVER['DOCUMENT_ROOT']."/teste_locaweb/trunk/";
            require_once $caminho."Tweet.php";
            require_once $caminho."Usuario.php";
            require_once $caminho."ResultadoTweet.php";
            
            $listaTweet = unserialize($_SESSION['tweets']);
//            $idUsers = unserialize($_SESSION['idUsers']);
            
            $listaTweetMenc = array();
            $idUsers = array();
            $mostMentionsLocaweb = array();            
            $listaUsuarios = array();            
            $listagemTweets = array();
            
            foreach ($listaTweet as $lisTwe){
                if ($lisTwe->getId_str_mentions() == 42){
                    array_push($listaTweetMenc, $lisTwe);
                    if (!in_array($lisTwe->getId_str_user(), $idUsers)){
                        array_push($idUsers, $lisTwe->getId_str_user());
                    }
                }
            }
            
            for ($i=0; $i<count($idUsers);$i=$i+1){
                $id = $idUsers[$i];
                $ret = array_filter($listaTweetMenc, function ($lista) use ($id){
                                                    return $lista->getId_str_user() == $id;
                                                 }
                        );
                
                $totalSeguidores = 0;
                $totalRetweets = 0;
                $totalLikes = 0;
                $totalMentions = 0;
                                
                usort(
                    $ret,
                    function($a,$b) {
                        if($a->getAvaliacao() == $b->getAvaliacao()) return 0;
                        return (($a->getAvaliacao() > $b->getAvaliacao()) ? -1 : 1 );
                    }
                );
                
                
                foreach ($ret as $rt){
                   $totalSeguidores = $rt->getFollowersCount();
                   $totalRetweets += $rt->getRetweetCount();
                   $totalLikes += $rt->getFavoritesCount();
                   $totalMentions = $totalMentions+ 1;
                }

                $usuario = new Usuario();
                
                $usuario->setIdUser($id);
                $usuario->setTotalFollowers($totalSeguidores);
                $usuario->setTotalLikes($totalLikes);
                $usuario->setTotalRetweets($totalRetweets);
                $usuario->setTotalMentions($totalMentions);
                $usuario->setIdPosi($i);
                
                $usuario->avaliarTweetUsuario();
                
                array_push($listaUsuarios, $usuario);
                array_push($mostMentionsLocaweb, $ret);
            }
            
            usort(
                $listaUsuarios,
                function($a,$b) {
                    if($a->getTotalMentions() == $b->getTotalMentions()) return 0;
                    return (($a->getTotalMentions() > $b->getTotalMentions()) ? -1 : 1 );
                }
            );
            
            for ($i=0; $i<count($listaUsuarios);$i=$i+1){
                
                $subarray = array();
                
                $posi = $listaUsuarios[$i]->getIdPosi();

                foreach($mostMentionsLocaweb[$posi] as $mm) {
                    $resultado = new ResultadoTweet();
                    $resultado->setCreated_at($mm->getCreatAt());
                    $resultado->setFavourites_count($mm->getFavoritesCount());
                    $resultado->setFollowers_count($mm->getFollowersCount());
                    $resultado->setRetweet_count($mm->getRetweetCount());
                    $resultado->setText($mm->getText());
                    $resultado->setScreen_name($mm->getScreenName());
                    $resultado->setLink_perfil('http://www.twitter.com/'.$mm->getScreenName());
                    $resultado->setLink_tweet('http://www.twitter.com/'.$mm->getScreenName().'/status/'.$mm->getId_str_tweet());

                    array_push($subarray, $resultado);
                    
                }
                array_push($listagemTweets,$subarray);
                    
            }
            //var_dump($listagemTweets);
            //echo $json = json_encode($listagemTweets);

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
              <p>Aqui estão listados os usuários que mais mencionaram a Locaweb, e seus respectivos tweets, os quais foram ordenados de acordo com as seguintes regras:<br>(1) Usuários com mais seguidores<br>(2) Tweets que tenham mais retweets<br>(3) Tweet com mais likes</p>
              <!--<p><a class="btn btn-primary btn-lg" href="arquivo.json" target="_blank" role="button">Visualizar JSON &raquo;</a></p>-->
            </div>
        </div>
        <div class="container">
        <ul class="nav nav-tabs" role="tablist">
          <li role="presentation" class="active"><a href="#classif" aria-controls="classif" role="tab" data-toggle="tab"><b>Classificação dos usuários</b></a></li>
          <li role="presentation"><a href="#tweets" aria-controls="tweets" role="tab" data-toggle="tab"><b>Tweets dos Usuários</b></a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
          <div role="tabpanel" class="tab-pane active" id="classif">
              <div class="panel panel-default">
                <!--<div class="panel-heading"></div>-->
                <!--<div class="panel-body">
                  <p>Os usuários aqui foram classificados considerando o número de vezes que eles mencionaram a empresa.</p>
                </div>-->
                <table class="table">
                    <ul class="list-group">
                        <?php
                            foreach ($listagemTweets as $lt){
                                echo '<li class="list-group-item">&raquo; '.$lt[0]->getScreen_name().'</li>';
                            }
                        ?>
                    </ul>
                </table>
              </div>
          </div>
          <div role="tabpanel" class="tab-pane" id="tweets">
              <table class="table">
                <tr>
                    <th width="7%">Screen Name</th>
                    <th width="30%">Conteúdo</th> 
                    <th width="5%">Seguidores</th> 
                    <th width="5%">Retweets</th>
                    <th width="5%">Likes</th>
                    <th width="20%">Data/Hora do tweet</th>
                </tr>
                <?php
                    //$i = 1;
                    foreach ($listagemTweets as $lt){
                        echo '<tr>';
                        $rows = count($lt);
                        echo '<td rowspan="'.$rows.'"><a href="'.$lt[0]->getLink_perfil().'" target="_blank">@'.$lt[0]->getScreen_name().'</a></td>';
                        foreach ($lt as $r){
                            echo '<td>'.$r->getText().'</td>';
                            echo '<td>'.$r->getFollowers_count().'</td>';
                            echo '<td>'.$r->getRetweet_count().'</td>';
                            echo '<td>'.$r->getFavourites_count().'</td>';
                            echo '<td><a href="'.$r->getLink_tweet().'" target="_blank">@'.$r->getCreated_at().'</a></td>';
                            echo '</tr>';
                        }
                        echo '</tr>';
                        //$i = $i +1;
                    }
                ?>
            </table>               
          </div>
        </div>
      </div>
        
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>

    </body>
</html>
