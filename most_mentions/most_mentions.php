<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="screen">
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
            
            $idUsers = unserialize($_SESSION['idUsers']);
            
            $mostMentionsLocaweb = array();
            
            $listaUsuarios = array();
            
            $listagemTweets = array();
            
            for ($i=0; $i<count($idUsers);$i=$i+1){
                $id = $idUsers[$i];
                $ret = array_filter($listaTweet, function ($lista) use ($id){
                                                    return $lista->getId_str_user() == $id;
                                                 }
                        );
                $totalSeguidores = 0;
                $totalRetweets = 0;
                $totalLikes = 0;
                
                for ($j=0; $j < count($ret); $j = $j+1){
                   $totalSeguidores = $ret[$i]->getFollowersCount();
                   $totalRetweets += $ret[$i]->getRetweetCount();
                   $totalLikes += $ret[$i]->getFavoritesCount();
                }
                
                $usuario = new Usuario();
                
                $usuario->setIdUser($id);
                $usuario->setTotalFollowers($totalSeguidores);
                $usuario->setTotalLikes($totalLikes);
                $usuario->setTotalRetweets($totalRetweets);
                $usuario->setIdPosi($i);
                
                $usuario->avaliarTweetUsuario();
                //echo $usuario->getAvaliacao();
                
                array_push($listaUsuarios, $usuario);
                array_push($mostMentionsLocaweb, $ret);
            }

            usort(
                $listaUsuarios,
                function($a,$b) {
                    if($a->getAvaliacao() == $b->getAvaliacao()) return 0;
                    return (($a->getAvaliacao() > $b->getAvaliacao()) ? -1 : 1 );
                }
            );
            
            for ($i=0; $i<count($listaUsuarios);$i=$i+1){
                $resultado = new ResultadoTweet();
                $subarray = array();
                
                $posi = $listaUsuarios[$i]->getIdPosi();

                foreach($mostMentionsLocaweb[$posi] as $mm) {
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
            
            echo $json = json_encode($listagemTweets);

        ?>       
    </body>
</html>
